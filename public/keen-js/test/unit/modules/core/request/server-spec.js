var chai = require("chai"),
    expect = require("chai").expect,
    JSON2 = require("JSON2"),
    spies = require("chai-spies");

chai.use(spies);

var Keen = require("../../../../../src/server"),
    keenHelper = require("../../../helpers/test-config"),
    mock = require("../../../helpers/mockServerRequests");

describe("Keen.Request", function() {

  beforeEach(function() {
    this.client = new Keen({
      projectId: keenHelper.projectId,
      readKey: keenHelper.readKey
    });
    this.query = new Keen.Query("count", {
      eventCollection: "test-collection"
    });
  });

  afterEach(function(){
    this.client = void 0;
    this.query = void 0;
  });

  describe("<Client>.run method", function(){

    it("should be a method", function(){
      expect(this.client.run).to.be.a("function");
    });

    it("should throw an error when passed an invalid object", function(){
      var self = this;
      expect(function(){ self.run(null); }).to.throw(Error);
      expect(function(){ self.run({}); }).to.throw(Error);
      expect(function(){ self.run(0); }).to.throw(Error);
      expect(function(){ self.run("string"); }).to.throw(Error);
    });

    it("should return a response when successful", function(done){
      var response = { result: 1 };
      mock.post("/queries/count", 200, JSON2.stringify(response));
      this.client.run(this.query, function(err, res){
        expect(err).to.be.a("null");
        expect(res).to.deep.equal(response);
        done();
      });
    });

    it("should return an error when unsuccessful", function(done){
      var response = { error_code: "ResourceNotFoundError", message: "no foo" };
      mock.post("/queries/count", 500, JSON2.stringify(response));
      this.client.run(this.query, function(err, res){
        expect(err).to.exist;
        expect(err["code"]).to.equal(response.error_code);
        expect(res).to.be.a("null");
        done();
      });
    });

    it("should return an error when timed out", function(){
      mock.post("/queries/count", 500, '{ "timeout": 1, "message": "timeout of 1ms exceeded" }', 1000);
      var req = new Keen.Request(this.client, [this.query], function(err, res){
        expect(err).to.exist;
        expect(err["message"]).to.equal("timeout of 1ms exceeded");
        expect(res).to.be.a("null");
      });
      req
        .timeout(1)
        .refresh();
    });

    describe("Multiple queries", function(){
      it("should return a single response when successful", function(done){
        var response = [{ result: 1 }, { result: 1 }, { result: 1 }];
        mock.post("/queries/count", 200, JSON2.stringify(response[0]));
        mock.post("/queries/count", 200, JSON2.stringify(response[1]));
        mock.post("/queries/count", 200, JSON2.stringify(response[2]));
        this.client.run([this.query, this.query, this.query], function(err, res){
          expect(err).to.be.a("null");
          expect(res).to.be.an("array").and.to.have.length(3);
          expect(res).to.deep.equal(response);
          done();
        });
      });
      it('should return a single error when unsuccessful', function(done){
        var response = { error_code: "ResourceNotFoundError", message: "no foo" };
        mock.post("/queries/count", 500, JSON2.stringify(response));
        mock.post("/queries/count", 200, JSON2.stringify({ result: 1 }));
        mock.post("/queries/count", 200, JSON2.stringify({ result: 1 }));
        this.client.run([this.query, this.query, this.query], function(err, res){
          expect(err).to.exist;
          expect(err["code"]).to.equal(response.error_code);
          expect(res).to.be.a("null");
          done();
        });
      });
    });

  });

});

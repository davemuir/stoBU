# Record Events

Hey, let's record some events!


## Record a single event

Here is an example for recording a "purchases" event. Note that dollar amounts are tracked in cents:

```javascript
// Configure an instance for your project
var client = new Keen({...});

// Create a data object with the properties you want to send
var purchaseEvent = {
  item: "golden gadget",  
  price: 2550,
  referrer: document.referrer,
  keen: {
    timestamp: new Date().toISOString()
  }
};

// Send it to the "purchases" collection
client.addEvent("purchases", purchaseEvent, function(err, res){
  if (err) {
    // there was an error!
  }
  else {
    // see sample response below
  }
});
```

### API response for saving a single event

```json
{
  "created": true
}
```

Send as many events as you like. Each event will be fired off to the Keen IO servers asynchronously.


## Record multiple events

Here is an example for how to record multiple events with a single API call. Note that dollar amounts are tracked in cents:

```javascript
// Configure an instance for your project
var client = new Keen({...});

var multipleEvents = {
  "purchases": [
    { item: "golden gadget", price: 2550, transaction_id: "f029342" },
    { item: "a different gadget", price: 1775, transaction_id: "f029342" }
  ],
  "transactions": [
    {
      id: "f029342",
      items: 2,
      total: 4325
    }
  ]
};

// Send multiple events to several collections
client.addEvents(multipleEvents, function(err, res){
  if (err) {
    // there was an error!
  }
  else {
    // see sample response below
  }
});
```

### API response for saving multiple events

```json
{
  "purchases": [
    {
      "success": true
    },
    {
      "success": true
    }
  ],
  "transactions": [
    {
      "success": true
    }
  ]
}
```


## A few simple guidelines

**Property names** must follow these rules:

  * Cannot start with the $ character
  * Cannot contain the . character anywhere
  * Cannot be longer than 256 characters

**Dates** are always handled in ISO-8601 format.

`keen.timestamp` is automatically added to each event, unless you provide a custom value in its place. This is the actual time when an event occurs.

`keen.created_at` is automatically set by our servers once the event is received. This value cannot be overwritten.


## Track Links and Forms

Recording user interactions for links and forms can be challenging. There’s a lot of complexity around making sure the data is recorded before the browser moves to the next page. We handle that complexity for you with the trackExternalLink method.

Method: **trackExternalLink(** jsEvent, eventCollection, properties [ , timeout, callback ] **)**

Parameters:

  * **jsEvent** - A reference to the JavaScript event that was triggered
  * **eventCollection** - A string containing the name of the event collection to use
  * **properties** - A JavaScript object, the event properties associated with the event
  * **timeout** - An integer indicating the amount of time in milliseconds to wait before moving on
  * **callback** - A function to override the default behavior of navigating to the next page

Here's a basic example:


```javascript
document.getElementById("some-link").onclick = function(event){
  return client.trackExternalLink(event, "link_clicked", {});
};

document.getElementById("some-form").onsubmit = function(event){
  return client.trackExternalLink(event, "form_submitted", {});
}
```


## Inline link tracking

```javascript
<a href="http://www.google.com" onclick="return client.trackExternalLink(event, 'visit_google', {'user_id' : 12345});">Click me!</a>
```

## Inline form tracking

```javascript
<form action="http://foo.com" method="POST" onsubmit="return client.trackExternalLink(event, 'submit_form', {'form_property_1' : 12345});">
  <input type="submit" value="submit">
</form>
```

## Tracking click events with [jQuery](http://jquery.com)

```javascript
$("a").click(function(event){
  return client.trackExternalLink(event, "external_link_click", {'form_property_2' : 987665});
});
```


## Set Global Properties

Global properties are sent with EVERY event. For example, you may wish to always capture browser information like the userAgent, location or referrer.

Method: **setGlobalProperties(** function **)**

Parameters:

  * **function** - A function that accepts an `eventCollection` string as an argument and returns an object containing the properties to add to that event.

```javascript
// Previously created instance
var client = new Keen({...});

// Create a factory function
var myGlobalProperties = function(eventCollection) {

  // Create global properties
  var globalProperties = {
    count: 42
  };

  // Special treatment for a specific event collection
  if (eventCollection === "purchase") {
    globalProperties["isPurchase"] = true;
  }

  return globalProperties;
};

// Apply factory function
client.setGlobalProperties(myGlobalProperties);

```

**Important:** This function is executed prior to uploading each event, so global properties can be overwritten by simply assigning a property of the same name when recording an event.

<div id="clock">
            <div id="time"></div>
            <div id="date"></div>
        </div>
<script type="text/javascript">
   function startTime() {
        
        //var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        //var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        var todayC= new Date();
        var hClock=todayC.getHours();
        var min=todayC.getMinutes();
        var sec=todayC.getSeconds();
        var d = todayC.getDate();
        var Mo = todayC.getMonth();
        var ye = todayC.getFullYear();


        //var day = days[ todayC.getDay() ];
        //var month = months[ todayC.getMonth() ];

        min = checkTime(min);
        sec = checkTime(sec);
        document.getElementById('time').innerHTML = hClock+":"+min;
        document.getElementById('date').innerHTML = d+"/"+Mo+"/"+ye;
        var t = setTimeout(function(){startTime()},500);
    }
    function checkTime(a) {
        if (a<10) {a = "0" + a};  // add zero in front of numbers < 10
        return a;
    }
        startTime();
</script>
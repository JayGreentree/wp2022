// CHURCH ONLINE TIMER - V2
const CURRENT_SERVICE_QUERY = `
query CurrentService {
  currentService(onEmpty: LOAD_NEXT) {
    id
    startTime
    endTime
    content {
      title
    }
  }
}
`;

// Get day
var today = new Date();
today.toLocaleString('en-US', { timeZone: 'America/Chicago' });
var todayDay = today.getDay();

console.log(todayDay);

function showMessage(){
  document.getElementById("featured-churchonline").classList.add("hide");
  document.getElementById("featured-message").classList.remove("hide");
}

function showTimer(){
  document.getElementById("featured-churchonline").classList.remove("hide");
  document.getElementById("featured-message").classList.add("hide");  
}

function showTimerCard(){
  document.getElementById("churchonline-card").classList.remove("hide");  
  document.getElementById("featured-churchonline").classList.add("hide");
}

async function startCountdown() {
  // Fetch the current or next service data
  const service = await fetch("https://cityfirstchurch.online.church/graphql", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json"
    },
    body: JSON.stringify({
      query: CURRENT_SERVICE_QUERY,
      operationName: "CurrentService"
    })
  })
    .then((response) => response.json())
    .catch((error => {
      console.error(error),
      showMessage();
    }));
    
  
  // If no service was returned from the API, don't display the countdown
  // Show the Featured Message
  if (!service.data.currentService || !service.data.currentService.id) {
    document.getElementById("featured-message").classList.remove("hide");
    return;
  }

  // Set the service title
  //document.getElementById("serviceTitle").innerText =
  //  service.data.currentService.content.title;

  // Set the date we're counting down to
  const startTime = new Date(service.data.currentService.startTime).getTime();
  const endTime = new Date(service.data.currentService.endTime).getTime();

  // Create a one second interval to tick down to the startTime
  const intervalId = setInterval(function () {
    const now = new Date().getTime();

    // If we are between the start and end time, the service is live
    if (now >= startTime && now <= endTime) {
      clearInterval(intervalId);
      
     
      if(todayDay === 0){ // IF SUNDAY

        // SHOW ONLY HEADER TIMER
        document.getElementById("btn-co-timer").innerHTML = "<span class='label alert'>LIVE</span>&nbsp;&nbsp;WATCH ONLINE!";
        document.getElementById("btn-co-timer").classList.remove("hide");
        document.getElementById("featured-churchonline").classList.remove("hide");

      }else{ // IF NOT SUNDAY
      
        // SHOW CARD TIMER & FEATURED MESSAGE

        document.getElementById("churchonline-card-title").innerText = service.data.currentService.content.title;
        document.getElementById("churchonline-card-timer").innerHTML = "<span class='label alert'>WATCH LIVE</span>";
        document.getElementById("churchonline-card").classList.remove("hide");
        document.getElementById("featured-message").classList.remove("hide");

      }
      //document.getElementById("btn-christmas").classList.add("hide");
      
      return;
    }

    // Find the difference between now and the start time
    const difference = startTime - now;

    
    // Pad function to add leading zeros
      Number.prototype.pad = function(size) {
        var s = String(this);
        while (s.length < (size || 2)) {s = "0" + s;}
        return s;
      }
    // Time calculations for days, hours, minutes and seconds
    const days = Math.floor(difference / (1000 * 60 * 60 * 24));
    
    //Hide Day if 0. Otherwise, Add leading zero.
    var D = '';
    if(days > 0){
      D = days.pad(2) + ":";
    }
    
    
    const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).pad(2);
    const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60)).pad(2);
    const seconds = Math.floor((difference % (1000 * 60)) / 1000).pad(2);

    // HEADER TIMER
    // Display the results in the element with id="countdown"
    document.getElementById("btn-co-timer").innerHTML =
    //"Next Service - " + D + hours + ":" + minutes + ":" + seconds + "";
    "Next Online Service<br/><span style='font-weight:300;'>" + D + hours + ":" + minutes + ":" + seconds + "</span>";

    // CARD TIMER
    // Display the results in the element with id="countdown"
    document.getElementById("churchonline-card-title").innerText = service.data.currentService.content.title;
    document.getElementById("churchonline-card-timer").innerHTML = "Service begins in " + D + hours + ":" + minutes + ":" + seconds;


    // BEFORE LIVE
    if(days > 0){ // IF MORE THAN A DAY AWAY
    
      showMessage();

    }else{ // IF LESS THAN A DAY AWAY
      
       if(todayDay === 6 || todayDay === 0){ // IF SUNDAY
        
        // SHOW ONLY HEADER TIMER
        showTimer();
         
       }else{ // IF NOT SUNDAY

        document.getElementById("churchonline-card").classList.remove("hide");
        document.getElementById("featured-message").classList.remove("hide");
         
       }
    }

    //console.log(days);


    // CHRISTMAS SERVICES
    /*if(days > 0){
      document.getElementById("btn-co-timer").classList.add("hide");
      document.getElementById("btn-christmas").classList.remove("hide");
      document.getElementById("christmas-times").classList.add("hide");
    }else{
      document.getElementById("btn-co-timer").classList.remove("hide");
      document.getElementById("btn-christmas").classList.add("hide");
      document.getElementById("christmas-times").classList.remove("hide");
    }*/

    // If we are past the end time, clear the countdown
    if (difference < 0) {
      clearInterval(intervalId);
      document.getElementById("btn-co-timer").innerHTML = "Watch Church Online";
      return;
    }
  }, 1000);
}

startCountdown();

jQuery.noConflict();
jQuery(document).ready(function($){
  
  // CARD - CLOSE BUTTON
	$('#churchonline-card-close').click(function(){
		$('#churchonline-card').fadeOut(200);
	});
  
});
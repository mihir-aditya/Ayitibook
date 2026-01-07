function counterCountdown() {
		let days = 3; // Starting days
		let hours = 23; // Starting hours
		let minutes = 19; // Starting minutes
		let seconds = 56; // Starting seconds
	
		const second = 1000, minute = second * 60, hour = minute * 60, day = hour * 24;
	
		const x = setInterval(() => {
		// Decrement the time
		if (seconds > 0) {
			seconds--;
		} else if (minutes > 0) {
			minutes--;
			seconds = 59;
		} else if (hours > 0) {
			hours--;
			minutes = 59;
			seconds = 59;
		} else if (days > 0) {
			days--;
			hours = 23;
			minutes = 59;
			seconds = 59;
		}
	
		// Update the countdown display
		document.getElementById("days1").innerText = String(days).padStart(2, "0");
		document.getElementById("hours2").innerText = String(hours).padStart(2, "0");
		document.getElementById("minutes3").innerText = String(minutes).padStart(2, "0");
		document.getElementById("seconds4").innerText = String(seconds).padStart(2, "0");

		}, 1000);
	}
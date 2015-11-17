


function Shake(options) {
	var shake = this,
		watchId = null,
		defaultOptions = {
			frequency: 300,
			waitBetweenShakes: 1000,
			threshold: 12,
			success: undefined,
			failure: undefined
		},
		previousAcceleration;
	for (var p in defaultOptions)
		if (!options.hasOwnProperty(p))
			options[p] = defaultOptions[p];

	// Start watching the accelerometer for a shake gesture
	shake.startWatch = function () {
		if (watchId)
			return;
		watchId = navigator.accelerometer.watchAcceleration(getAccelerationSnapshot, handleError, {
			frequency: options.frequency
		});
	};

	// Stop watching the accelerometer for a shake gesture
	shake.stopWatch = function () {
		if (!watchId)
			return;
		navigator.accelerometer.clearWatch(watchId);
		watchId = null;
	};

	// Gets the current acceleration snapshot from the last accelerometer watch
	function getAccelerationSnapshot() {
		navigator.accelerometer.getCurrentAcceleration(assessCurrentAcceleration, handleError);
	}

	// Assess the current acceleration parameters to determine a shake
	function assessCurrentAcceleration(acceleration) {
		if (!previousAcceleration) {
			previousAcceleration = acceleration;
			return;
		}
		var accelerationDelta = {
			x: acceleration.x - previousAcceleration.x,
			y: acceleration.y - previousAcceleration.y,
			z: acceleration.z - previousAcceleration.z
		};
		var magnitude = Math.sqrt(
			Math.pow(accelerationDelta.x, 2) +
			Math.pow(accelerationDelta.y, 2) +
			Math.pow(accelerationDelta.z, 2)
		);
		if (magnitude >= options.threshold) {
			// Shake detected
			if (options.waitBetweenShakes > 0) {
				shake.stopWatch();
				previousAcceleration = undefined;
			}
			options.success.call(shake, magnitude, accelerationDelta, acceleration.timestamp);
			if (options.waitBetweenShakes > 0)
				setTimeout(
					function() {
						shake.startWatch();
					},
					options.waitBetweenShakes
				);
		}
		else
			previousAcceleration = acceleration;
	}

	// Handle errors here
	function handleError() {
		if (options.failure)
			options.failure.call(shake);
	}
};


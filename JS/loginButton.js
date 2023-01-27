(function () {
	document.querySelectorAll('.ripple').forEach(setRippleElement);
})()

function setRippleElement(el) {
	const dot = document.createElement('SPAN');
	const largestSide = Math.sqrt(
		Math.pow(el.offsetWidth, 2) +
		Math.pow(el.offsetHeight, 2)
	);
	const dotSize = Math.ceil((largestSide * 2) / 100);
	const rippleColor = el.dataset.rippleColor || '#768b8c';

	dot.style = `
		position: absolute;
		left: 0;
		top: 0;
		width: ${dotSize}px;
		height: ${dotSize}px;
		z-index: 3;
		border-radius: 50%;
		background: ${rippleColor};
		transform: translate(-50%, -50%) scale(1);
		opacity: 0.5;
		animation: ripple 1s ease-out forwards;
	`;

	el.style.position = 'relative';
	el.style.overflow = 'hidden';

	el.addEventListener('click', ({pageX, pageY, currentTarget}) => {
		// x and y in percentages
		const x = ((pageX - currentTarget.offsetLeft) * 100)  / currentTarget.offsetWidth;
		const y = ((pageY - currentTarget.offsetTop) * 100)  / currentTarget.offsetHeight;

		el.appendChild(dot);

		dot.style.left = x + '%';
		dot.style.top = y + '%';
	})
}
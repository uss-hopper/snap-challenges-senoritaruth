/**
 *
 *Adds the unique positive factors of a number.
 *
 * @param number The number to be factored
 * @return sum of the factors.
 *
 **/

function someUniquePositiveFactors(number) {
	let sum = 0;

	for (i=1; i<=number; i++) {
		if (number % i === 0) {
		sum = sum + i;
		}
	}

	return sum;
}
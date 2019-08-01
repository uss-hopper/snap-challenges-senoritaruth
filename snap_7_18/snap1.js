/**
 *
 *converb weight or mass to grams.
 * @param mass The weight of mass to be converted.
 * @param units The abbreviation for the units specified in the mass.
 * @return The converted mass in grams.
 **/

function convertToGrams(mass, units) {
	$convertedValue = 0;

	if (units === 'g') {
		return mass;
	} else if (units === 'lbs') {
		return mass * 453.592;
	} else if (units === 'oz') {
		return mass * 28.35;
	} else if (units === 'kg') {
		return mass * 1000;
	} else if (units === 'mg') {
		return mass / 1000;
	}

	return $convertedValue;
}

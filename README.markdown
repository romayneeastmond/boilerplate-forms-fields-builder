# Boilerplate Forms Fields Builder

Quickly reduce the amount of time needed to generate bootstrap form fields. Simply enter the id, label, field name, type on a single line and then press submit to have the HTML code generated on the fly. Also generates code for a C# Class, PHP Class, Angular boilerplate, and React Native boilerplate code.

## Examples

Provide a module name for the form fields and then seperate each field name with a line. Use Id, Label, Field Name, Type format.

##### Normal input textbox
* FirstName, First Name, firstName, text

##### Email input textbox
* EmailAddress, Email Address, emailAddress, email

##### Checkbox
* RememberMe, Remember Me, rememberMe, checkbox

##### Radio with options
* Gender, Gender, male|female, radio

##### Select with options
* Province, Province, Alberta|Ontario|Quebec, select

##### Textarea
* Comments, Comments, comments, textarea

## Example for Compound Interest Calculator Fields

###### Module Name
```
CompoundInterest
```

###### Form Fields
```
currentPrincipal, Current Principal, currentPrincipal, text
annualAddition, Annual Addition, annualAddition, text
years, Years to Grow, years, number
interestRate, Interest Rate, interestRate, text
compoundInterest, Compound Interest, compoundInterest, text
additions, Make Additions, start|end, radio
submit, Submit, submit, submit
```

###### Bootstrap Output
```
 <form id="CompoundInterestForm">
	<div class="form-group">
		<label for="currentPrincipal">Current Principal</label>
		<input type="text" id="currentPrincipal" name="currentPrincipal" class="form-control" placeholder="Enter Current Principal"/>
	</div>
	<div class="form-group">
		<label for="annualAddition">Annual Addition</label>
		<input type="text" id="annualAddition" name="annualAddition" class="form-control" placeholder="Enter Annual Addition"/>
	</div>
	<div class="form-group">
		<label for="years">Years to Grow</label>
		<input type="number" id="years" name="years" class="form-control" placeholder="Enter Years to Grow"/>
	</div>
	<div class="form-group">
		<label for="interestRate">Interest Rate</label>
		<input type="text" id="interestRate" name="interestRate" class="form-control" placeholder="Enter Interest Rate"/>
	</div>
	<div class="form-group">
		<label for="compoundInterest">Compound Interest</label>
		<input type="text" id="compoundInterest" name="compoundInterest" class="form-control" placeholder="Enter Compound Interest"/>
	</div>
	<div class="form-group">
		<div class="radio">
			<label>Make Additions</label>
			<input type="radio" name="additions" value="start"> start
			<input type="radio" name="additions" value="end"> end
		</div>
	</div>
	<div class="form-group">
		<input type="submit" id="submit" name="Submit" class="form-control" />
	</div>	
</form>	
```

## Copyright and Ownership

All terms used are copyright to their original authors.

## Live Demo

Live demo hosted in Microsoft Azure, PHP 7.4 App Service [Boilerplate Forms Fields Builder](https://dev-php-boilerplate-forms.azurewebsites.net/).

Azure F1 instances are :snowflake: ice cold. That first load will need some :sun_with_face: warming up.
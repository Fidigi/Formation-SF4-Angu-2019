class Product {
	private _name: string;
	private _ref: string;

	constructor(name: string) {
		this._name = name;
	}
	
	// setter
	set name(name: string) {
		this._name = name;
	}

	set ref(ref: string) {
		this._ref = ref;
	}

	// getter
	get name(): string {
		return this._name;
	}

	get ref(): string {
		return this._ref;
	}
}

// instance de la classe

let bike = new Product('Super Bike');

console.log(`name :${bike.name}, ref : ${bike.ref}`)
///////
///////
abstract class Music {
	protected _instrument: string = 'nothing';

	constructor(name: string = 'nothing') {
		this._instrument = name;
	}

	abstract makeSound():string;

	play(): string {
		return "play music";
	}
	
	// setter
	set instrument(instrument: string) {
		this._instrument = instrument;
	}

	// getter
	get instrument(): string {
		return this._instrument;
	}
}

class Guitar extends Music{
	protected _instrument: string = 'Guitar';

	// Implémentez le code utile
	makeSound(): string {
		return 'guitar noise';
	}
}

let guitar = new Guitar();

guitar.instrument = 'Guitar folk';

console.log(guitar.instrument);
console.log(guitar.makeSound());
///////
///////
interface Duck{
	name : string ;
	swim(): string;
}
class Thing implements Duck{
	
	name: string = 'Thing';

	swim(): string {
		return 'paf le chien';
	}
}

let thing = new Thing();

console.log(thing.name);
console.log(thing.swim());
///////
///////
class Recipe {
	name: string;
	star?: number; // ?NameAttribut <=> attribut facultatif
}

let recipes: Recipe[] = [];// Array<Recipe> ~ Recipe[]

let mocRecipes=[
	{name:'toto',star:5},
	{name:'tutu'},
	{name:'titi',star:4}
];

mocRecipes.forEach(recipe=>{
	recipes.push(recipe);
}) 

console.log(recipes);

recipes.forEach(recipe=>{
	console.log(recipe.name+" : "+recipe.star);
})

class Product {
    constructor(name) {
        this._name = name;
    }
    // setter
    set name(name) {
        this._name = name;
    }
    set ref(ref) {
        this._ref = ref;
    }
    // getter
    get name() {
        return this._name;
    }
    get ref() {
        return this._ref;
    }
}
// instance de la classe
let bike = new Product('Super Bike');
console.log(`name :${bike.name}, ref : ${bike.ref}`);
///////
///////
class Music {
    constructor(name = 'nothing') {
        this._instrument = 'nothing';
        this._instrument = name;
    }
    play() {
        return "play music";
    }
    // setter
    set instrument(instrument) {
        this._instrument = instrument;
    }
    // getter
    get instrument() {
        return this._instrument;
    }
}
class Guitar extends Music {
    constructor() {
        super(...arguments);
        this._instrument = 'Guitar';
    }
    // Implémentez le code utile
    makeSound() {
        return 'guitar noise';
    }
}
let guitar = new Guitar();
guitar.instrument = 'Guitar folk';
console.log(guitar.instrument);
console.log(guitar.makeSound());
class Thing {
    constructor() {
        this.name = 'Thing';
    }
    swim() {
        return 'paf le chien';
    }
}
let thing = new Thing();
console.log(thing.name);
console.log(thing.swim());
///////
///////
class Recipe {
}
let recipes = []; // Array<Recipe> ~ Recipe[]
let mocRecipes = [
    { name: 'toto', star: 5 },
    { name: 'tutu' },
    { name: 'titi', star: 4 }
];
mocRecipes.forEach(recipe => {
    recipes.push(recipe);
});
console.log(recipes);
recipes.forEach(recipe => {
    console.log(recipe.name + " : " + recipe.star);
});

function modify(model: string){
	let newModel = model;
	return function (target, key, descriptor) {
		descriptor.value = () => newModel;
	};
}

function feature(config){
	return function (target) {
		Object.defineProperty(
			target.prototype,
			'swim',
			{
				value: () => config.action,
			}
		);
	};
}

@feature({action: "Nage"}) 
class Duck {
	say(){return "I'm duck";}

	@modify('Donald')
	name(){return "Duck";}
}

let duck = new Duck;
console.log(duck.say());
console.log(duck.name());
console.log(duck.swim());
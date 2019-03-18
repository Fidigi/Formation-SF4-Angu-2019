"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
function modify(model) {
    let newModel = model;
    return function (target, key, descriptor) {
        descriptor.value = () => newModel;
    };
}
function feature(config) {
    return function (target) {
        Object.defineProperty(target.prototype, 'swim', {
            value: () => config.action,
        });
    };
}
let Duck = class Duck {
    say() { return "I'm duck"; }
    name() { return "Duck"; }
};
__decorate([
    modify('Donald'),
    __metadata("design:type", Function),
    __metadata("design:paramtypes", []),
    __metadata("design:returntype", void 0)
], Duck.prototype, "name", null);
Duck = __decorate([
    feature({ action: "Nage" })
], Duck);
let duck = new Duck;
console.log(duck.say());
console.log(duck.name());
console.log(duck.swim());

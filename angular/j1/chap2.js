class Queue {
    constructor() {
        this.list = [];
    }
    push(nombre) {
        this.list.push(nombre);
    }
    pop() {
        return this.list.pop();
    }
}
let queue = new Queue();
queue.push(1);
queue.push(2);
queue.push(3);
queue.push(4);
console.log(queue.pop()); // affiche 4

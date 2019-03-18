class Queue<T> {

	list: T[] = [];

	push(nombre: T): void{
		this.list.push(nombre);
	}

	pop(): T{
		return this.list.pop();
	}
}

let queue = new Queue<number>();

queue.push(1);
queue.push(2);
queue.push(3);
queue.push(4);

console.log(queue.pop()); // affiche 4
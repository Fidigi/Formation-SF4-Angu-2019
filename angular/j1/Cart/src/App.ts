
import { Product } from './Product';
import { Details, Delivery, MockDetails, MockDelivery } from './data/MockProducts';

let products: Array<Product<Details, Delivery>> = [];

MockDetails.forEach((detail) => {
    let mockDelivery = MockDelivery.find(delivery => delivery.id == detail.id);
    products.push(new Product<Details, Delivery>(detail, mockDelivery.delivery));
});

// Affichez que les produits dont l'option est "spécial"

let specialProducts = products.filter(product => product.option === Delivery.Special );

console.log(specialProducts);
// console.log(products);


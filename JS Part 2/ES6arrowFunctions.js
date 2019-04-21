let addTwo = (x, y) => x + y;               // arrow function
let logOne = value => console.log(value);   // with a single argument
let logMany = (x, ...rest) => {             // with a body
  console.log(x, ...rest);                  // we can still use return
};

[1, 2, 3, 4, 5, 6, 7, 8, 9]
  .filter(e => e % 2 == 0)    // [2, 4, 6, 8]
  .map(e => e * e)            // [4, 16, 36, 64]
  .reduce((a, b) => a + b)    // 120

const meet = (name='partner', greeting='Howdy') => { // default params
    friends.push({name: name, greeting: greeting});

    return `${greeting}, ${name}!`;           // No need for + ' ' + stuff
};

// Arrow functions preserve the context of the scope where they are defined in
name  = 'Super Global';
ivan = {name: 'Ivan'};

const sayHi = () => `Hi, ${this.name}!`;

console.log(sayHi()); // Hi, undefined!

ivan.sayHi = sayHi;
console.log(ivan.sayHi()); // Hi, undefined!


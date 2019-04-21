// We create a lib using immediately invoked function expression
// All functions, objects and variables in this lib are behaving 
// as they are in private scope
var lib = (function() {
    function sayHi() {
        console.log('Hello!');
    }

    // We return an object with everything we want to access outside
    // the immediately invoked function expression scope
    return {
        sayHi: sayHi()
    };
})();

// We don't have direct access to the method sayHi()
// sayHi(); // Error

// We can call the method sayHi() as it is a property of lib
lib.sayHi(); // Hello!
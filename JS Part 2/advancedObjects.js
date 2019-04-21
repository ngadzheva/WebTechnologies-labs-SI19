// Constructor function
function Student(name, fn, age) {
    this.name = name;
    this.fn = fn;
    this.age = age;

    // On every new created object will be created a new function
    this.info = function() {
        console.log(this.fn + ': ' + this.name + ' ' + this.age());
    };
}

function Age(age) {
    this.age = age;

    this.getAge = function() {
        return this.age;
    };
}

// We create new object using the constructor function Age and the key word new
var age = new Age(22);

// We create new object using the constructor function Student and the key word new
// The third parameter is the age object's method getAge()
// We preserve the context of the object age, using bind()
var ivan = new Student('Ivan', '62999', age.getAge.bind(age));
// The context of this is the context of the object's ivan
ivan.info(); // 62999: Ivan 22

// This way we don't create an object
// The context of pesho will be the context of the global scope
var pesho = Student('Pesho', '62998', age.getAge.bind(age));
// This way we can call the Student's method info 
// And the context of this will be the context of the global scope
info(); // 62998: Pesho 22

// We add property to the propertype of the Student
// This way on every new created object won't be created a new function
// All instances of Student will have access to this property
Student.prototype.getName = function() {
    return this.name;
}

console.log(ivan.getName()); // Ivan

// Dynamically creating objects
var maria = {};

Object.defineProperties(maria, {
    name: {
        get: function () {
            return name;
        },
        set: function(newName) {
            name = newName;
        }
    },
    fn: {
        get: function () {
            return fn;
        },
        set: function(newFn) {
            fn = newFn;
        }
    }
});

// Here we get the name and fn properties, which are in the global scope
console.log(maria.name); // Pesho
console.log(maria.fn); // 62998

// Here we bind new values specifically for maria's object properties name and fn
maria.name = 'Maria';
maria.fn = '61997';
console.log(maria.name); // Maria
console.log(maria.fn); // 61997

// Creating object with object literal a.k.a Namespacing
var gosho = {
    name: 'Gosho',
    age: 22
};

// Create a copy of the object gosho
// This copy is behaving as a prototype of the object gosho
var joro = Object.create(gosho);
console.log(joro.name + ' ' + joro.age); // Gosho 22

// We add new property to object gosho. This property will also be added to object joro
gosho.bothProp = 'both';
// We change the value of the age property of the object gosho
// The value of the same property of the object joro will also be changed
gosho.age = 23;
console.log(joro.bothProp); // both
console.log(joro.age); // 23

// Create a deep copy of the object
// The changes in the two objects doesn't affect the other one
var george = JSON.parse(JSON.stringify(gosho));
george.fn = 62999;
gosho.name = 'Joro';
console.log(george.fn); // 62999
console.log(george.name); // Gosho
console.log(gosho.fn); // undefined
console.log(gosho.name); // Joro
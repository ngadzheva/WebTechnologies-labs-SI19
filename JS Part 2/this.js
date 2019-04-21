// name is in the global scope
name = "Super Global";
var pesho = {age: 22, name: "Pesho"};
var gosho = {age: 21, name: "Gosho"};
var ivan = {age: 23, name: "Ivan"};

// sayHi is a function
var sayHi = function () {
  return "Hi, I am " + this.name;
};

// We call sayHi() without binding context, so the context of this will be the global scope
console.log(sayHi());                  // Hi, I am Super Global

// We add new property to the object pesho, which value is the function sayHi()
pesho.sayHi = sayHi;
console.log(pesho.sayHi.toString());   // function () { return "Hi, I am " + this.name; }
// We call the object's pesho property sayHi, so the context of this will be the object's pesho scope
console.log(pesho.sayHi());            // Hi, I am Pesho

// We use call() to call the function sayHi(), binding object's gosho context to it
console.log(sayHi.call(gosho));        // Hi, I am Gosho (arguments are passed after the new context seperated by commas)
// We use call() to call the object's pesho property sayHi, binding object's gosho context to it
console.log(pesho.sayHi.call(gosho));  // the same 

// We use apply() to call the function sayHi(), binding object's ivan context to it
console.log(sayHi.apply(ivan));        // Hi, I am Ivan (arguments are passed after the new context as an array)

// Here this will be in student object's context
var student = {
  name: 'Student',
  fn: '62886',
  info: function() {
    return this.name + ' ' + this.fn;
  }
};
console.log(student.info()); // Student 62886

// Here this will be in global context
var studentInfo = student.info;
console.log(studentInfo()); // Super Global undefined

// We use bind() to call student object's method info with it's own context
var bindedStudentInfo = student.info.bind(student);
console.log(bindedStudentInfo()); // Student 62886

// Switching context
var sayHiStudent = pesho.sayHi.bind(student);
console.log(sayHiStudent()); //Hi, I am Student
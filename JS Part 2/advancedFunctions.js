function updateScore(score) {
    var bonus = 10;

    var increment = function() {
        // Here we can access the variable score as well as the variable bonus
        // This is called closure (we can access variables from the upper scope)
        var superBonus = 20;

        score += bonus + superBonus;

        return score;
    }

    // Here we can't access the variable superBonus

    return increment();
}

console.log(updateScore(10)); // 40

// Currying
function add(a) {
    return function(b) {
        return a + b;
    }
}

console.log(add(5)(6)); // 11

// Simple callback example
function callbackExample(params, callback) {
    return callback(params);
}

function byFive(a) {
    return a * 5;
}

console.log(callbackExample(6, byFive)); // 30

// We should aware using callback functions, because it can result in a callback hell
var callbackHell = callbackExample(6, function(a) {
    var b = 5;

    return function(c) {
        return a * b * c;
    }
});

console.log(callbackHell(7)); // 210
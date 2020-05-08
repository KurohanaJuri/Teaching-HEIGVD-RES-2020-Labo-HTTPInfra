var Chance = require('chance');
var chance = new Chance();

// Generate random students
exports.generateStudents = function(){
    var numberOfStudents = chance.integer({min : 0, max : 10});

    console.log(numberOfStudents);

    var students = [];

    for(var i = 0; i < numberOfStudents; i++){
        var gender = chance.gender();
        var birthYear = chance.year({
            min : 1986,
            max : 1996
        });

        students.push({
            firstName : chance.first({gender:gender}),
            lastNmae : chance.last,
            gender : gender,
            birthday : chance.birthday({
                year : birthYear
            })
        });
    };

    console.log(students);
    return students;
}

exports.generateRandomArray = function(nb, minVal ,maxVal){
    var res = [];

    for (var i = 0; i < nb; i++){
        res.push(chance.integer({min : minVal, max : maxVal}));
    }

    console.log(res);
    return res;
}

// 5.2.js

function calculateSum() {
    let inputArray = document.getElementById('numberInput').value.split(',').map(Number);
    let sum = 0;
  
    for (let i = 0; i < inputArray.length; i++) {
        if (Math.sin(inputArray[i]) > 0) {
            break;
        }
        sum += inputArray[i];
    }

    // Удаление элементов, удовлетворяющих условию (модуль целой части - число с чётными цифрами)
    let filteredArray = inputArray.filter(function(number) {
        let integerPart = Math.abs(Math.trunc(number));
        let digits = integerPart.toString().split('').map(Number);
        return !digits.every(function(digit) {
            return digit % 2 === 0;
        });
    });

    document.getElementById('sumResult').innerText = "Сумма элементов массива до первого положительного синуса: " + sum;
    document.getElementById('filteredArrayResult').innerText = "Массив после удаления элементов, в модуле которых все цифры в целой части чётные: " + filteredArray.join(', ');
}

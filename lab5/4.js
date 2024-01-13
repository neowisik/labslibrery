// 5.4.js

function countSyllables() {
    let word = document.getElementById('wordInput').value.trim().toLowerCase();
    let syllableCount = 0;

    if (word.length === 0) {
        alert("Введите слово!");
        return;
    }

    // Подсчет слогов по простым правилам (количество гласных)
    for (let i = 0; i < word.length; i++) {
        if (isRussianVowel(word[i])) {
            syllableCount++;
        }
    }

    document.getElementById('result').innerHTML = "Результат подсчета слогов в слове \"" + word + "\": " + syllableCount;
}

function isRussianVowel(char) {
    return ['a','e','i','o','u','y','а','е','ё','и','о','у','ы','э','ю','я'].indexOf(char) !== -1;
}

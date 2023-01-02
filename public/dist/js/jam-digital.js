function showTime() {
    // Mengambil elemen HTML
    let time = document.getElementById("time");
    let date = document.getElementById("date");

    // Mendapatkan waktu sekarang
    let now = new Date();

    // Mendapatkan jam, menit, dan detik
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();

    // Mengkonversi jam menjadi format 12 jam
    if (hours > 12) {
        hours -= 12;
    } else if (hours === 0) {
        hours = 12;
    }

    // Menambahkan 0 di depan jam, menit, dan detik jika kurang dari 10
    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    if (seconds < 10) {
        seconds = "0" + seconds;
    }

    // Menampilkan waktu dan tanggal di elemen HTML
    time.innerHTML = hours + ":" + minutes + ":" + seconds;
    date.innerHTML = now.toDateString();
}

// Menjalankan fungsi showTime setiap 1 detik
setInterval(showTime, 1000);

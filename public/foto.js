
// Preview foto dari file input
function previewFoto(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview-foto').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Ambil gambar dari kamera
function ambilGambar() {
    const video = document.getElementById('video-capture');
    const canvas = document.getElementById('canvas-capture');
    const preview = document.getElementById('preview-foto');
    const btnCapture = document.getElementById('btn-capture');
    const btnCancel = document.getElementById('btn-cancel-capture');
    // Tampilkan video
    video.style.display = 'block';
    btnCapture.style.display = 'block';
    btnCancel.style.display = 'block';
    preview.style.display = 'none';
    canvas.style.display = 'none';

    // Mulai kamera dengan ukuran sedang (240x240)
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({
            video: {
                width: 240,
                height: 240
            }
        }).then(function (stream) {
            video.srcObject = stream;
            video.play();
        });
    }
}

function captureFoto() {
    const video = document.getElementById('video-capture');
    const canvas = document.getElementById('canvas-capture');
    const preview = document.getElementById('preview-foto');
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    // Stop kamera
    if (video.srcObject) {
        video.srcObject.getTracks().forEach(track => track.stop());
    }
    // Tampilkan hasil
    canvas.style.display = 'none';
    preview.src = canvas.toDataURL('image/png');
    preview.style.display = 'block';
    video.style.display = 'none';
    document.getElementById('btn-capture').style.display = 'none';
    document.getElementById('btn-cancel-capture').style.display = 'none';

    // Simpan data ke input file (opsional, jika ingin upload hasil capture)
    // Konversi dataURL ke file dan set ke input file
    dataURLtoFile(canvas.toDataURL('image/png'), 'capture.png').then(function (file) {
        let dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        document.getElementById('foto').files = dataTransfer.files;
    });
}

function cancelCapture() {
    const video = document.getElementById('video-capture');
    const preview = document.getElementById('preview-foto');
    const canvas = document.getElementById('canvas-capture');
    video.style.display = 'none';
    document.getElementById('btn-capture').style.display = 'none';
    document.getElementById('btn-cancel-capture').style.display = 'none';
    preview.style.display = 'block';
    canvas.style.display = 'none';
    // Stop kamera
    if (video.srcObject) {
        video.srcObject.getTracks().forEach(track => track.stop());
    }
}

// Helper: convert dataURL to File
function dataURLtoFile(dataurl, filename) {
    return fetch(dataurl)
        .then(res => res.arrayBuffer())
        .then(buf => new File([buf], filename, {
            type: 'image/png'
        }));
}

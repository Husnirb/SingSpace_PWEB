const STORAGE_KEY = 'singspace_reservations';

const initialData = [
    { id: "1711640000001", nama: "Andi Syaputra", email: "andi@mail.com", telepon: "081234567890", ruangan: "vip", tanggal: "2026-03-28", jam: "18:00", durasi: "2", catatan: "Siapkan mic tambahan", status: "Confirmed" },
    { id: "1711640000002", nama: "Sinta Maharani", email: "sinta@mail.com", telepon: "085678901234", ruangan: "vvip", tanggal: "2026-03-28", jam: "20:00", durasi: "3", catatan: "", status: "Pending" },
    { id: "1711640000003", nama: "Budi Santoso", email: "budi@mail.com", telepon: "089876543210", ruangan: "family", tanggal: "2026-03-29", jam: "14:00", durasi: "2", catatan: "", status: "Confirmed" },
    { id: "1711640000004", nama: "Citra Kirana", email: "citra@mail.com", telepon: "082123456789", ruangan: "regular", tanggal: "2026-03-29", jam: "16:00", durasi: "1", catatan: "AC tolong didinginkan", status: "Cancelled" }
];

let reservations = JSON.parse(localStorage.getItem(STORAGE_KEY)) || initialData;

const form = document.getElementById('bookingForm');
const tableBody = document.getElementById('tableBody');
const errorDiv = document.getElementById('errorMessages');
const searchInput = document.getElementById('searchInput');
const filterRuangan = document.getElementById('filterRuangan');
const filterStatus = document.getElementById('filterStatus');

const inputEditId = document.getElementById('editId');
const inputNama = document.getElementById('nama');
const inputEmail = document.getElementById('email');
const inputTelepon = document.getElementById('telepon');
const inputRuangan = document.getElementById('ruangan');
const inputTanggal = document.getElementById('tanggal');
const inputJam = document.getElementById('jam');
const inputDurasi = document.getElementById('durasi');
const inputCatatan = document.getElementById('catatan');

const btnSubmit = document.getElementById('btnSubmit');
const btnCancelEdit = document.getElementById('btnCancelEdit');

const statTotal = document.getElementById('statTotal');
const statConfirmed = document.getElementById('statConfirmed');
const statPending = document.getElementById('statPending');
const statVipVvip = document.getElementById('statVipVvip');

const saveToStorage = () => {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(reservations));
};

const getTodayString = () => {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    return `${yyyy}-${mm}-${dd}`;
};

const validateForm = () => {
    let errors = [];
    
    if (inputNama.value.trim().length < 3) errors.push("Nama minimal 3 karakter.");
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(inputEmail.value.trim())) errors.push("Format email tidak valid.");
    
    const phoneRegex = /^\d{10,}$/;
    if (!phoneRegex.test(inputTelepon.value.trim())) errors.push("Nomor telepon minimal 10 digit dan hanya angka.");
    
    if (inputRuangan.value === "") errors.push("Ruangan wajib dipilih.");
    
    if (inputTanggal.value < getTodayString()) errors.push("Tanggal tidak boleh sebelum hari ini.");
    
    if (inputJam.value === "") errors.push("Jam wajib diisi.");
    
    if (parseInt(inputDurasi.value) < 1 || isNaN(inputDurasi.value)) errors.push("Durasi minimal 1 jam.");

    return errors;
};

const updateStats = () => {
    const total = reservations.length;
    const confirmed = reservations.filter(res => res.status === 'Confirmed').length;
    const pending = reservations.filter(res => res.status === 'Pending').length;
    
    const vipVvipCount = reservations.reduce((acc, curr) => {
        return (curr.ruangan === 'vip' || curr.ruangan === 'vvip') ? acc + 1 : acc;
    }, 0);

    statTotal.innerText = total;
    statConfirmed.innerText = confirmed;
    statPending.innerText = pending;
    statVipVvip.innerText = vipVvipCount;
};

const renderTable = () => {
    const searchText = searchInput.value.toLowerCase();
    const filterR = filterRuangan.value;
    const filterS = filterStatus.value;

    const filteredData = reservations.filter(res => {
        const matchSearch = res.nama.toLowerCase().includes(searchText) || res.ruangan.toLowerCase().includes(searchText);
        const matchRuangan = filterR === 'All' ? true : res.ruangan === filterR;
        const matchStatus = filterS === 'All' ? true : res.status === filterS;
        
        return matchSearch && matchRuangan && matchStatus;
    });

    tableBody.innerHTML = filteredData.map(res => `
        <tr>
            <td>${res.nama}</td>
            <td style="text-transform: uppercase;">${res.ruangan}</td>
            <td>${res.tanggal}</td>
            <td>${res.jam}</td>
            <td>${res.durasi} Jam</td>
            <td>
                <span style="padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; 
                    background-color: ${res.status === 'Confirmed' ? '#10B981' : (res.status === 'Pending' ? '#F59E0B' : '#EF4444')}; 
                    color: white;">
                    ${res.status}
                </span>
            </td>
            <td>
                <button class="btn-edit" data-id="${res.id}" style="background: #3B82F6; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; margin-right: 5px;">Edit</button>
                <button class="btn-delete" data-id="${res.id}" style="background: #EF4444; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">Hapus</button>
            </td>
        </tr>
    `).join('');

    updateStats();
};

form.addEventListener('submit', (e) => {
    e.preventDefault();
    errorDiv.innerHTML = ''; 

    const errors = validateForm();
    if (errors.length > 0) {
        errorDiv.innerHTML = errors.map(err => `<div>• ${err}</div>`).join('');
        return;
    }

    const formData = {
        nama: inputNama.value.trim(),
        email: inputEmail.value.trim(),
        telepon: inputTelepon.value.trim(),
        ruangan: inputRuangan.value,
        tanggal: inputTanggal.value,
        jam: inputJam.value,
        durasi: inputDurasi.value,
        catatan: inputCatatan.value.trim()
    };

    const editId = inputEditId.value;

    if (editId) {
        const index = reservations.findIndex(res => res.id === editId);
        if (index !== -1) {
            reservations[index] = { ...reservations[index], ...formData };
            alert('Data reservasi berhasil diupdate!');
        }
    } else {
        const newReservation = {
            id: Date.now().toString(),
            status: "Pending", 
            ...formData
        };
        reservations.push(newReservation);
        alert('Reservasi baru berhasil ditambahkan!');
    }

    saveToStorage();
    renderTable();
    resetForm();
});

tableBody.addEventListener('click', (e) => {
    const id = e.target.getAttribute('data-id');
    
    if (e.target.classList.contains('btn-delete')) {
        if (confirm('Apakah Anda yakin ingin menghapus data reservasi ini?')) {
            reservations = reservations.filter(res => res.id !== id);
            saveToStorage();
            renderTable();
            
            if(inputEditId.value === id) resetForm();
        }
    }

    if (e.target.classList.contains('btn-edit')) {
        const dataEdit = reservations.find(res => res.id === id);
        if (dataEdit) {
            inputEditId.value = dataEdit.id;
            inputNama.value = dataEdit.nama;
            inputEmail.value = dataEdit.email;
            inputTelepon.value = dataEdit.telepon;
            inputRuangan.value = dataEdit.ruangan;
            inputTanggal.value = dataEdit.tanggal;
            inputJam.value = dataEdit.jam;
            inputDurasi.value = dataEdit.durasi;
            inputCatatan.value = dataEdit.catatan;

            btnSubmit.innerText = 'Update Reservasi';
            btnCancelEdit.style.display = 'block';
            
            form.scrollIntoView({ behavior: 'smooth' });
            errorDiv.innerHTML = '';
        }
    }
});

btnCancelEdit.addEventListener('click', () => {
    resetForm();
});

searchInput.addEventListener('input', renderTable);
filterRuangan.addEventListener('change', renderTable);
filterStatus.addEventListener('change', renderTable);

const resetForm = () => {
    form.reset();
    inputEditId.value = '';
    btnSubmit.innerText = 'Booking Sekarang';
    btnCancelEdit.style.display = 'none';
    errorDiv.innerHTML = '';
};

saveToStorage(); 
renderTable();
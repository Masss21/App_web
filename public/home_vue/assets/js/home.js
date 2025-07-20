const { createApp } = Vue

createApp({
  data() {
    return {
      nama: '',
      telepon: '',
      pesan: '',
      galeri: [
        { gambar: 'assets/img/servis1.jpg', judul: 'Servis Rutin', deskripsi: 'Pengecekan oli, rem, dan rantai motor.' },
        { gambar: 'assets/img/servis2.jpg', judul: 'Ganti Ban', deskripsi: 'Kami sediakan berbagai ukuran dan merk ban.' },
        { gambar: 'assets/img/servis3.jpg', judul: 'Servis Mesin', deskripsi: 'Perawatan menyeluruh pada komponen mesin.' },
        { gambar: 'assets/img/servis4.jpg', judul: 'Sparepart', deskripsi: 'Penggantian suku cadang asli dan bergaransi.' },
      ]
    }
  },
  methods: {
    scrollToForm() {
      this.$refs.formSection.scrollIntoView({ behavior: 'smooth' })
    },
    goToLogin() {
      window.location.href = '/app_web/public/admin/login'
    },
    submitAntrian() {
      const form = new URLSearchParams()
      form.append('nama', this.nama)
      form.append('telepon', this.telepon)

      axios.post('/app_web/public/pelanggan/submit-antrian', form)
        .then(() => {
          this.pesan = 'Berhasil ambil nomor antrian!'
          this.nama = ''
          this.telepon = ''
        })
        .catch(() => {
          this.pesan = 'Gagal kirim antrian.'
        })
    }
  }
}).mount('#app')

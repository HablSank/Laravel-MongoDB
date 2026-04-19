# 📚 Dokumentasi API Perpustakaan (Laravel MongoDB + JWT)

Dokumentasi ini berisi daftar endpoint API untuk manajemen data buku. Aplikasi ini menggunakan **MongoDB** sebagai database dan **JWT (JSON Web Token)** untuk sistem keamanan akses.

**Base URL:** `http://localhost:8000/api`

---

## 🔐 1. Authentication Endpoints

### **Register**
Mendaftarkan pengguna (admin) baru ke sistem.
- **URL:** `/register`
- **Method:** `POST`
- **Auth Required:** No

**Request Body (JSON):**

| Parameter | Tipe | Keterangan |
| :--- | :--- | :--- |
| `name` | string | Wajib. Nama lengkap. |
| `email` | string | Wajib. Format email valid dan unik. |
| `password` | string | Wajib. Minimal 8 karakter. |

**Contoh Payload:**
```json
{
  "name": "Yuta",
  "email": "yuta@example.com",
  "password": "password123"
}
```

---

### **Login**
Autentikasi pengguna untuk mendapatkan JWT token.
- **URL:** `/login`
- **Method:** `POST`
- **Auth Required:** No

**Request Body (JSON):**

| Parameter | Tipe | Keterangan |
| :--- | :--- | :--- |
| `email` | string | Wajib. |
| `password` | string | Wajib. |

**Response (200 OK):**
```json
{
  "access_token": "eyJ0eXAi...",
  "token_type": "bearer",
  "expires_in": 3600
}
```

---

## 📖 2. Books Endpoints (CRUD)

> **Catatan:** Beberapa endpoint di bawah ini dilindungi oleh otentikasi JWT.
> **Header Wajib:** `Authorization: Bearer <token_dari_login>`

---

### **Get All Books**
Mendapatkan semua daftar koleksi buku.
- **URL:** `/books`
- **Method:** `GET`
- **Auth Required:** No (Publik)

---

### **Create Book**
Menambahkan data buku baru ke database MongoDB.
- **URL:** `/books`
- **Method:** `POST`
- **Auth Required:** Yes

**Request Body (JSON):**

| Parameter | Tipe | Keterangan |
| :--- | :--- | :--- |
| `judul` | string | Wajib. |
| `penulis` | string | Wajib. |
| `tahun_terbit` | integer | Wajib. |
| `kategori` | string | Wajib. |

---

### **Update Book**
Memperbarui data buku berdasarkan ID MongoDB.
- **URL:** `/books/{id}`
- **Method:** `PUT / PATCH`
- **Auth Required:** Yes

---

### **Delete Book**
Menghapus data buku secara permanen.
- **URL:** `/books/{id}`
- **Method:** `DELETE`
- **Auth Required:** Yes

**Response (200 OK):**
```json
{
  "status": "success",
  "message": "Buku berhasil dihapus"
}
```
# TÀI LIỆU DỰ ÁN: HỆ THỐNG KẾT NỐI GIA SƯ VÀ HỌC VIÊN

## 1. PHẠM VI CÔNG VIỆC

### 1.1. Nhiệm vụ 1: Phân tích Yêu cầu
Xác định các yêu cầu chức năng và phi chức năng của hệ thống:

* **Đối với học viên:**
    * Đăng ký, đăng nhập.
    * Quản lý hồ sơ cá nhân.
    * Tìm kiếm gia sư (theo môn học, địa điểm, trình độ).
    * Đặt lịch học.
    * Nhắn tin trao đổi.
    * Đánh giá gia sư.
    * Thanh toán học phí.
* **Đối với gia sư:**
    * Quản lý hồ sơ (kinh nghiệm, bằng cấp, lịch rảnh).
    * Xác thực thông tin.
    * Quản lý lịch dạy.
    * Nhắn tin.
    * Xem đánh giá từ học viên.
* **Yêu cầu phi chức năng:**
    * Giao diện thân thiện.
    * Hiệu suất cao.
    * Bảo mật thông tin cá nhân.
    * Khả năng mở rộng (Scalability).
    * Tính sẵn sàng cao (High Availability).

### 1.2. Nhiệm vụ 2: Thiết kế Cơ sở Dữ liệu
Thiết kế cơ sở dữ liệu MySQL với các bảng chính:

* **Users:** Lưu thông tin người dùng (học viên, gia sư, admin) gồm: `id`, `name`, `email`, `password`, `role`.
* **TutorProfiles:** Lưu hồ sơ gia sư gồm: kinh nghiệm, bằng cấp, mức phí, lịch rảnh, môn dạy, khu vực.
* **Bookings:** Quản lý lịch học gồm: thời gian, trạng thái, giá, ghi chú.
* **Messages:** Hỗ trợ nhắn tin giữa học viên và gia sư gồm: nội dung, thời gian gửi, trạng thái đọc.
* **Reviews:** Lưu đánh giá và nhận xét từ học viên gồm: điểm số, bình luận.
* **Các bảng khác:** `Subjects`, `TutorSubjects`, `Notifications`, `AdminSettings`.

### 1.3. Nhiệm vụ 3: Phát triển Hệ thống
Xây dựng hệ thống web sử dụng các công nghệ:

* **Backend:**
    * Framework: **Laravel** (PHP).
    * Xác thực: **Laravel Breeze**.
    * Database Interaction: **Eloquent ORM**.
* **Frontend:**
    * Template Engine: **Blade Templates**.
    * Styling: **Tailwind CSS** (cho giao diện responsive và các thành phần tương tác).
* **Triển khai các chức năng:**
    * Quản lý hồ sơ.
    * Tìm kiếm gia sư với bộ lọc nâng cao.
    * Đặt lịch học.
    * Nhắn tin.
    * Đánh giá.
    * Bảng điều khiển quản trị (Admin Dashboard).

### 1.4. Nhiệm vụ 4: Kiểm thử và Triển khai
* Thực hiện **kiểm thử đơn vị (Unit Testing)** và **kiểm thử tích hợp (Integration Testing)** để đảm bảo chất lượng hệ thống.
* Triển khai hệ thống trên máy chủ với môi trường PHP, MySQL.
* Đảm bảo giao diện responsive, hoạt động mượt mà trên cả web và thiết bị di động.

---

## 2. KẾT QUẢ DỰ ÁN DỰ KIẾN

Các kết quả bàn giao của dự án bao gồm:

1.  Hệ thống web hoàn chỉnh hỗ trợ kết nối gia sư và học viên.
2.  Giao diện người dùng thân thiện, responsive, hoạt động tốt trên cả trình duyệt web và thiết bị di động.
3.  Cơ sở dữ liệu MySQL tối ưu, hỗ trợ tìm kiếm và quản lý hiệu quả.
4.  Tích hợp cổng thanh toán trực tuyến an toàn (Stripe hoặc PayPal).
5.  Bảng điều khiển quản trị viên với báo cáo thống kê chi tiết.

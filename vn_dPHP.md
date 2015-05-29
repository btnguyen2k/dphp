# Giới thiệu #
dPHP là dự án mã nguồn mở, phát triển các thư viện, framework và ứng dụng trên nền ngôn ngữ lập trình PHP.

dPHP được phát triển theo hướng pure-OO, do vậy dPHP sẽ không hỗ trợ PHP4! Hiện tại dPHP được phát triển cho PHP5.x

# Package #
dPHP sử dụng _package_ để **đặt tên** và **nhóm** các sản phầm của mình vào các sub-project. Package trong dPHP có cách đặt tên tương tự như cách đặt tên của package trong Java.
Ví dụ:
  * `Ddth` là package `Ddth`.
  * `Ddth::Commons` là package con `Commons` của package `Ddth`. Đồng thời `Ddth::Commons` cũng là tên của 1 sub-project của dPHP.

Hiện tại, tất cả các package của dPHP đều nằm dưới top-level package `Ddth`.

# Module #
Module là 1 component trong 1 sub-project.
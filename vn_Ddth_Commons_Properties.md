# Giới thiệu #
Module `Properties` cung cấp cho các ứng dụng PHP một phương cách đơn giản nhưng hiệu quả sử dụng các file properties để lưu trữ các cấu hình của ứng dụng. Cấu hình của ứng dụng là tập hợp các cặp `[key=>value]` được lưu trong các file trên đĩa và sẽ được chuyển thành 1 "hash-table" thông qua sự trợ giúp của module `Properties`.

# Cấu trúc 1 file properties #
Module `Properties` hỗ trợ file text có cấu trúc tương tự như file .properties của Java.

  * Các dòng bắt đầu bằng **#** hoặc **;** là các comment.
  * Một cặp `[key=>value]` được lưu trên 1 dòng với cấu trúc `key=value`.
  * Value có thể "span" trên nhiều dòng, để nối value với dòng tiếp theo, bạn để ký tự \ ở cuối dòng trước.

Ví dụ:
```
;this is a comment
     #this is also a comment
 key1=value1
 key2 = value2
 key3  =     multiple-line value \
     value line 2 \
     ; value line 3 \
     # value line 4
```

# Sử dụng module Properties #
Module `Properties` được gói gọn trong class `Ddth_Commons_Properties`. Sau khi include file `ClassProperties.php`, bạn có thể bắt đầu sử dụng module `Properties`:
```
$prop = new Ddth_Commons_Properties();

//set a property
$prop->setProperty('key', 'value');

//get a property
echo $prop->getProperty('key');

$prop->load('/config/my.properties');
```

_Xem thêm cách sử dụng và API của module `Properties` trong phpDoc._

# Ghi chú #
Module `Properties` hiện tại chỉ hỗ trợ chức năng load properties từ file hoặc import properties từ string. Chức năng save và export sẽ được phát triển trong tương lai gần.
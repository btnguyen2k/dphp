# Giới Thiệu #

Package Ddth::Commons là sub-project "đầu tay" của dPHP. Package này chứa các interface, class và các thư viện (utility class, helper class, v.v...) sẽ được sử dụng thường xuyên trong các package khác của dPHP.


# Release Notes #

_Package Ddth::Commons đang trong giai đoạn "sơ khởi" nên version sẽ luôn là 0.1 cho đến khi đạt được đủ mức độ trường thành!_

## 11-Feb-2008: version 0.1\_3 ##
  * Introduced package `Ddth::Commons::Logging`:
    * Interface(s): `ILog`
    * Class(es): `AbstractLog`, `LogConfigurationException`, `LogFactory`, `SimpleLog`
    * Several typos and minor bug fixes

## 05-Feb-2008: version 0.1\_2 ##
  * Introduced package {{Ddth::Commons::Exceptions}}:
    * `AbstractException`
    * `IllegalArgumentException`, `IllegalStateException`
    * `IOException`
  * Introduced `Properties` module:
    * Class(es): `Properties`

## 28-Jan-2008: version 0.1\_1 ##
  * Introduced `Loader` module:
    * Interface(s): `IClassNameTranslator`
    * Class(es): `Loader`, `DefaultClassNameTranslator`
sMusic
===

> 这是一个基于 CodeIgniter 框架编写的 PHP 校园点歌台程序


介绍
--
这是本蒟蒻 Fly 的第一个 PHP 作品，它有以下功能：

 - 搜索歌曲
 - 播放歌曲
 - 用户管理
 - 歌单记录
 - 自动播出
 - 响应式支持
 - ……
 
安装说明
--
1. 下载所有源代码并解压至网站目录
2. （Nginx 用户）编辑网站的 conf 文件，添加以下代码（[来源][1]）：
`   location / {
        try_files $uri $uri/ /index.php;
    }`
3. 确保网站 application 目录下的 session 和 config 目录可写，然后访问安装地址（http://example.com/install）
4. 在安装程序里填写相关信息，然后安装
5. 然后就可以了 √

使用说明
--
 - 默认管理员账号：admin@admin.com
 - 默认管理员密码：password
 - 安装成功后，请务必在第一时间修改管理员密码
 - 程序的主要配置文件在 application/config/smusic.php 内，如需要修改，可以自行编辑
 - 邮件相关的设置在 application/config/email.php 内，配置后才能发送找回密码的邮件
 - 自动播放功能会自动按照时间顺序，播放所有状态为“未播放”的歌曲。当播放器进度条走完后，才算播放完成；中途切换歌曲不会被记录状态
 - 如有问题，可以尝试自行修改代码。因为就算发了 issue 作者也不一定有时间来改
 - 程序在 PHP7.0 和 Mysql 5.6 下测试通过，理论上支持 PHP >= 5.3，欢迎自行尝试

一些说明
--
这是 Fly 的第一个真正意义上的 PHP 作品，所以代码写得炒鸡烂，还请多多包涵。
本程序使用 GPL v3 协议授权，可以在协议范围内随意使用。
页脚可以在 application/views/footer.php 内修改，可以自行修改页脚内容和友情链接，但是页面左下方的版权须予以保留。

sMusic 使用了以下开源程序：
 - 轻量级 PHP 开发框架 [CodeIgniter][2]
 - 基于 CodeIgniter 的用户系统模块 [ion Auth][3]
 - 基于 CodeIgniter 的 Gravatar 头像获取模块 [Codeigniter-Gravatar][4]
 - [Meting][5] （网易云音乐 API 模块）
 - [jQuery][6]
 - 强大的前端框架 [Materialize][7]
 - 轻量级前端框架 [Pure.css][8]
 - 炒鸡萌的 HTML5 音频播放器 [APlayer][9]
 - 社会化分享组件 [Share.js][10]

sMusic 参考了以下程序的代码：
 - [smuradio][11] （歌曲状态 div 的样式、搜索歌曲按钮的样式以及安装程序）

sMusic 使用了以下免费的 api 服务：
 - [LWL api][12]

截图
--
![首页][13]
![点歌界面][14]
![搜索歌曲][15]
![用户面板][16]
![历史歌单][17]
![后台首页][18]
![歌曲管理][19]
![自动播放][20]


  [1]: https://www.nginx.com/resources/wiki/start/topics/recipes/codeigniter/
  [2]: http://codeigniter.org.cn/
  [3]: https://github.com/benedmunds/CodeIgniter-Ion-Auth
  [4]: https://github.com/ivantcholakov/Codeigniter-Gravatar
  [5]: https://github.com/metowolf/Meting
  [6]: https://github.com/jquery/jquery
  [7]: https://github.com/Dogfalo/materialize
  [8]: https://github.com/yahoo/pure
  [9]: https://github.com/DIYgod/APlayer
  [10]: https://github.com/overtrue/share.js
  [11]: https://github.com/AddamsOne/smuradio
  [12]: https://blog.lwl12.com/?s=API
  [13]: https://img.cdn.lwl12.com/images/2017/04/03/1060fd0f2e61fd01771964928c1801b2.jpg
  [14]: https://img.cdn.lwl12.com/images/2017/04/03/418acf632578b781e6d91e2f72062734.jpg
  [15]: https://img.cdn.lwl12.com/images/2017/04/03/ec99a4087e46b025ca9b910770baff6b.jpg
  [16]: https://img.cdn.lwl12.com/images/2017/04/03/bf68c03cb0e43fa7107930bb6d7e19ce.jpg
  [17]: https://img.cdn.lwl12.com/images/2017/04/03/c21d782e12a72d40e008fe1483e97f3e.jpg
  [18]: https://img.cdn.lwl12.com/images/2017/04/03/2955a06220d95d322d895b5f7a3c5318.jpg
  [19]: https://img.cdn.lwl12.com/images/2017/04/03/aec6b0609605c8753b4a237e5dcafc4f.jpg
  [20]: https://img.cdn.lwl12.com/images/2017/04/03/9a3c46e2efce526389fab8aadb5cf812.jpg
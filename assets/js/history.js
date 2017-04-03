var ap,share_msg;

$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 5, // Creates a dropdown of 15 years to control year
    // Strings and translations
    monthsShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
    weekdaysShort: ['周日', '周一', '周二', '周三', '周四', '周五', '周六'],
    weekdaysFull: ['周日', '周一', '周二', '周三', '周四', '周五', '周六'],
    showMonthsShort: true,
    showWeekdaysFull: false,
    
    // Buttons
    today: '今天',
    clear: '清空',
    close: '确定',
    
    // Accessibility labels
    labelMonthNext: '下个月',
    labelMonthPrev: '上个月',
    labelMonthSelect: '请选择月份',
    labelYearSelect: '请选择年份',
    
    // Formats
    format: 'yyyy-mm-dd',
    formatSubmit: undefined,
    hiddenPrefix: undefined,
    hiddenSuffix: '_submit',
    hiddenName: undefined,
});

var input = $('.datepicker').pickadate();
var picker = input.pickadate('picker');
var Today=new Date();

date = Today.getFullYear() + '-' + (Today.getMonth()+1) + '-' + Today.getDate();
picker.set('select', date, { format: 'yyyy-m-d' })

function setShare() {
    if (url_date !== 'history') {
        url_date_length = url_date.length;
    } else {
        url_date_length = 0;
    }
    url = window.location.href;
    share_date = $(input).val();
    share_url = url.substring(0,url.length - url_date_length) + '/' + share_date;
    console.log(share_url);
    //Share.js不支持动态修改参数，所以重新创建对象
    var timestamp = Date.parse(new Date());
    $('.share').html('<div class="'+timestamp+'"></div>');
    var $config = {
        url                 : share_url, // 网址，默认使用 window.location.href
        source              : share_url, // 来源（QQ空间会用到）, 默认读取head标签：<meta name="site" content="http://overtrue" />
        title               : share_date + '的' + document.title, // 标题，默认读取 document.title 或者 <meta name="title" content="share.js" />
        description         : share_msg, // 描述, 默认读取head标签：<meta name="description" content="PHP弱类型的实现原理分析" />
        sites               : ['qzone', 'qq', 'weibo','wechat', 'douban'], // 启用的站点
        disabled            : ['google', 'facebook', 'twitter'], // 禁用的站点
        wechatQrcodeTitle   : "微信扫一扫：分享", // 微信二维码提示文字
        wechatQrcodeHelper  : '<p>打开微信，扫描二维码</p>',
    };
    $('.'+timestamp).share($config);
}

function getHistory(date) {
    try { ap.destroy() } catch (e){}; //暂时只能这样了，等 Diygod 女装回来再改
    share_msg = date + '的' + document.title + '：\n'; //初始化分享信息
    $.getJSON("api/get/history/"+date, function(json){
        $('#loading-icon').hide();
        total = json.history.length;
        if (total === 0) {
            $('#player').html('<p>然而这一天并没有什么歌单 ╮(╯▽╰)╭ </p>');
        } else {
            musicid = json.history[0].musicid;
            tittle = json.history[0].tittle;
            artist = json.history[0].artist;
            share_msg = share_msg + tittle + '、\n';
            console.log(share_msg);
            songurl = 'https://api.lwl12.com/music/netease/song?id=' + musicid;
            picurl = 'https://api.lwl12.com/music/netease/pic?id=' + musicid;
            lyricurl = 'https://api.lwl12.com/music/netease/lyric?id=' + musicid + '&raw=true';
            ap = new APlayer({
                element: document.getElementById('player'),
                narrow: false,
                autoplay: false,
                showlrc: 3,
                mutex: true,
                theme: '#b7daff',
                mode: 'circulation',
                preload: 'metadata',
                listmaxheight: '500px',
                music: {
                    title: tittle,
                    author: artist,
                    url: songurl,
                    pic: picurl,
                    lrc: lyricurl
                }
            });
            for (i=1;i<total;i++) {
                musicid = json.history[i].musicid;
                tittle = json.history[i].tittle;
                artist = json.history[i].artist;
                share_msg = share_msg + tittle + '、\n';
                console.log(share_msg);
                songurl = 'https://api.lwl12.com/music/netease/song?id=' + musicid;
                picurl = 'https://api.lwl12.com/music/netease/pic?id=' + musicid;
                lyricurl = 'https://api.lwl12.com/music/netease/lyric?id=' + musicid + '&raw=true';
                ap.addMusic([
                    {
                        title: tittle,
                        author: artist,
                        url: songurl,
                        pic: picurl,
                        lrc: lyricurl
                    }
                ]);
            }
        }
        console.log(share_msg);
        if (share_msg === date + '的' + document.title + '：\n') {
            share_msg = '本日暂无歌单';
        }
        setShare(); //歌曲全部获取完后设置分享
    });
}

var url= window.location.href;
var url_date = url.substring(url.lastIndexOf('/') + 1);
if (url_date !== 'history') {
    $(input).val(url_date);
    getHistory(url_date);
} else {
    getHistory($(input).val());
}


$(input).change(function () {
    $('#loading-icon').show();
    getHistory($(input).val());
});
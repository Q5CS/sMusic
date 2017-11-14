<div class="container">
    <div class="row" id="userbox">
        <div class="col s4">
            <img id="user-avatar" src="" class="circle responsive-img center-block">
        </div>
        <div class="col s8">
            <div  id="user-info-div">
                <p>Loading...</p>
                <!--Added by JavaScript-->
            </div>
            <a id="show-cpw-modal-btn" class="waves-effect waves-light btn">修改密码</a>
            <!--<a id="schoolid-btn" class="btn">绑定校园网账户</a>-->
        </div>
    </div>
</div>

<!-- ChangePassword Modal -->
<div id="cpw-modal" class="modal">
    <div class="modal-content">
        <h4>修改密码</h4>
        <div class="row">
            <div class="input-field col s12">
                <input id="user-cpw-old-pw" type="password" class="validate">
                <label for="password">原密码</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="user-cpw-new-pw" type="password" class="validate">
                <label for="password">新密码</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="user-cpw-confirm-pw" type="password" class="validate">
                <label for="password">确认新密码</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">取消</a>
            <a id="cpw-btn" class="modal-action waves-effect waves-light btn">修改</a>
    </div>
    </div>

<?php

use Typecho\Common;
use Widget\Options;
use Widget\Notice;

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

// 设置版本号
if (!defined("__THEME_VERSION__")) {
    define("__THEME_VERSION__", "1.7.4");
}
//icefox 核心包
include_once 'core/core.php';

function themeConfig($form)
{
    ?>
    <link rel="stylesheet" href="/usr/themes/icefox/assets/admin.css">
    <div>
        <div class="admin-title">Icefox主题后台配置（v<?php echo __THEME_VERSION__; ?>）</div>
        <div>
            <div>
                <?php
                $backgroundImageUrl = new Typecho_Widget_Helper_Form_Element_Text(
                    'backgroundImageUrl',
                    null,
                    null,
                    _t('站点顶部背景图'),
                    _t('在这里填入一个图片 URL 地址, 以在站点顶部显示该图片')
                );

                $form->addInput($backgroundImageUrl);

                $userAvatarUrl = new Typecho_Widget_Helper_Form_Element_Text(
                    'userAvatarUrl',
                    null,
                    null,
                    _t('用户头像'),
                    _t('在这里填入一个图片 URL 地址')
                );

                $form->addInput($userAvatarUrl);

                $avatarTitle = new Typecho_Widget_Helper_Form_Element_Text(
                    'avatarTitle',
                    null,
                    null,
                    _t('顶部用户头像旁名称'),
                    _t('在这里填入顶部用户头像胖展示的名称')
                );

                $form->addInput($avatarTitle);

                $topPost = new Typecho_Widget_Helper_Form_Element_Text(
                    "topPost",
                    null,
                    null,
                    "置顶文章",
                    "格式：文章的ID || 文章的ID || 文章的ID （中间使用 || 分隔）"
                );
                $form->addInput($topPost);

                $beian = new Typecho_Widget_Helper_Form_Element_Text(
                    "beian",
                    null,
                    null,
                    "备案号",
                    "例如：京ICP备00000001号"
                );
                $form->addInput($beian);

                $autoPlayVideo = new Typecho_Widget_Helper_Form_Element_Radio(
                    'autoPlayVideo',
                    [
                        'yes' => _t("是"),
                        'no' => _t("否")
                    ],
                    'yes',
                    _t('是否默认播放视频')
                );
                $form->addInput($autoPlayVideo);

                $autoMutedPlayVideo = new Typecho_Widget_Helper_Form_Element_Radio(
                    'autoMutedPlayVideo',
                    [
                        'yes' => _t("是"),
                        'no' => _t("否")
                    ],
                    'yes',
                    _t('是否默认静音播放视频')
                );
                $form->addInput($autoMutedPlayVideo);

                $neteasyCloudMusic = new Typecho_Widget_Helper_Form_Element_Text(
                    'neteasyCloudMusic',
                    null,
                    null,
                    _t('网易云音乐歌单地址（功能开发中）'),
                    _t('网页顶部播放器播放，目前只支持网易云音乐。')
                );
                $form->addInput($neteasyCloudMusic);

                $friendLinks = new Typecho_Widget_Helper_Form_Element_Textarea(
                    "friendLinks",
                    null,
                    null,
                    "友情链接（功能开发中）",
                    "使用||分隔，每一行一个友情链接。格式如下<br>logo || 名称 || 链接"
                );
                $form->addInput($friendLinks);

                $script = new Typecho_Widget_Helper_Form_Element_Textarea(
                    "script",
                    null,
                    null,
                    "全局自定义JavaScript",
                    "不用添加script标签"
                );
                $form->addInput($script);

                $css = new Typecho_Widget_Helper_Form_Element_Textarea(
                    "css",
                    null,
                    null,
                    "全局自定义CSS",
                    "不用添加style标签"
                );
                $form->addInput($css);

                ?>
            </div>
        </div>
    </div>

    <?php


    backupThemeData();
}

function themeFields($layout)
{
    ?>
<style>
    textarea{width:100%;height:8rem;}
    input[type=text]{width:100%;}
</style>
    <?php
    $friendVideo = new Typecho_Widget_Helper_Form_Element_Textarea(
        'friend_video',
        null,
        null,
        _t('朋友圈视频'),
        _t('<span>在这里填入朋友圈视频地址</span>')
    );
    $friendVideo->input->setAttribute('class', 't-video-find friend_video_input');
    $layout->addItem($friendVideo);

    $friendPicture = new Typecho_Widget_Helper_Form_Element_Textarea(
        'friend_pictures',
        null,
        null,
        _t('朋友圈图片'),
        _t('<span style="color:red;">不推荐，最好直接把图片添加在文章内容里面</span><br><span>在这里填入朋友圈图片，最多9张，使用英文逗号隔开（注：如果填了朋友圈视频，则优先视频）</span>')
    );
    $friendPicture->input->setAttribute('class', 't-default-find');
    $layout->addItem($friendPicture);

    $position = new Typecho_Widget_Helper_Form_Element_Text(
        'position',
        null,
        null,
        _t('发布定位'),
        _t('<span>在这里填定位名称（例：成都市·天府广场）</span>')
    );
    $position->input->setAttribute('class', 't-default-find');
    $layout->addItem($position);

    $isAdvertise = new Typecho_Widget_Helper_Form_Element_Radio(
        "isAdvertise",
        [
            "1" => _t("是"),
            "0" => _t("不是"),
        ],
        "0",
        _t("是否是广告"),
        _t('<span>默认不是</span>')
    );
    $isAdvertise->input->setAttribute('class', 't-default-find');
    $layout->addItem($isAdvertise);

    $music = new Typecho_Widget_Helper_Form_Element_Textarea(
        'music',
        null,
        null,
        _t('插入音乐'),
        _t('格式如下：<br>歌曲名称 || 专辑名称 || 播放地址 || 音乐图片')
    );
    $music->input->setAttribute('class', 't-music-find');
    $layout->addItem($music);

    // $canComment = new Typecho_Widget_Helper_Form_Element_Radio(
    //     "canComment",
    //     [
    //         "1" => _t("允许"),
    //         "0" => _t("不允许"),
    //     ],
    //     "1",
    //     _t("是否允许评论"),
    //     _t('<span style="color:red;">默认允许评论</span>')
    // );
    // $layout->addItem($canComment);
}

//自定义字段扩展
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('tabField', 'tabs');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('tabField', 'tabs');
class tabField {
    public static function tabs()
    {
    ?>
    <style>
        .tabss{margin:10px;clear:both;display:block;height:30px;padding:0};
        .tabss a{outline:none!important};        
    </style>

    <script>
        $(function(){
            var tabsHtml = `
                    <ul class="typecho-option-tabs tabss" style="">
                        <li class="current" id="t-default"><a href="javascript:;">默认</a></li>
                        <li class="" id="t-video"><a href="javascript:;">视频</a></li>
                        <li class="" id="t-music"><a href="javascript:;">音乐</a></li>
                    </ul>`;
            $("#custom-field-expand").after(tabsHtml);

            //初始化，全部隐藏
            $("#custom-field>table>tbody").find("tr").hide();

            //初始化显示
            $(".tabss>li.current").parent().siblings("table").find('.t-default-find').closest('tr').show();

            $(".tabss li").click(function(){
                var clasz = this.id;
                //删除同胞的current
                $(this).siblings().removeClass('current');
                //自身添加current
                $(this).addClass('current');
                //全部隐藏
                $("#custom-field>table>tbody").find("tr").hide();
                //显示自身底下的子元素
                $(".tabss>li.current").parent().siblings("table").find('.'+clasz+'-find').closest('tr').show();
            });
        });
    </script>
<?php
    }
}

/**
 * 备份主题数据
 * @return void
 */
function backupThemeData()
{
    $name = "icefox";
    $db = Typecho_Db::get();
    if (isset($_POST["type"])) {

        if ($_POST["type"] == "创建备份") {
            $value = $db->fetchRow(
                $db
                    ->select()
                    ->from("table.options")
                    ->where("name = ?", "theme:" . $name)
            )["value"];
            if (
                $db->fetchRow(
                    $db
                        ->select()
                        ->from("table.options")
                        ->where("name = ?", "theme:" . $name . "_backup")
                )
            ) {

                $db->query(
                    $db
                        ->update("table.options")
                        ->rows(["value" => $value])
                        ->where("name = ?", "theme:" . $name . "_backup")
                );
                Notice::alloc()->set("备份更新成功", "success");
                Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
            ?>
            <?php
            } else {
                ?>
                <?php if ($value) {

                    $db->query(
                        $db
                            ->insert("table.options")
                            ->rows(["name" => "theme:" . $name . "_backup", "user" => "0", "value" => $value])
                    );
                    Notice::alloc()->set("备份成功", "success");
                    Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
                ?>
                <?php
                }
            }
        }
        if ($_POST["type"] == "还原备份") {
            if (
                $db->fetchRow(
                    $db
                        ->select()
                        ->from("table.options")
                        ->where("name = ?", "theme:" . $name . "_backup")
                )
            ) {

                $_value = $db->fetchRow(
                    $db
                        ->select()
                        ->from("table.options")
                        ->where("name = ?", "theme:" . $name . "_backup")
                )["value"];
                $db->query(
                    $db
                        ->update("table.options")
                        ->rows(["value" => $_value])
                        ->where("name = ?", "theme:" . $name)
                );
                Notice::alloc()->set("备份还原成功", "success");
                Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
            ?>
            <?php
            } else {

                Notice::alloc()->set("无备份数据，请先创建备份", "error");
                Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
            ?>
            <?php
            } ?>
        <?php
        }
        ?>
        <?php if ($_POST["type"] == "删除备份") {
            if (
                $db->fetchRow(
                    $db
                        ->select()
                        ->from("table.options")
                        ->where("name = ?", "theme:" . $name . "_backup")
                )
            ) {

                $db->query($db->delete("table.options")->where("name = ?", "theme:" . $name . "_backup"));
                Notice::alloc()->set("删除备份成功", "success");
                Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
            ?>
            <?php
            } else {

                Notice::alloc()->set("无备份数据，无法删除", "success");
                Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
            ?>
            <?php
            } ?>
        <?php
        } ?>
    <?php
    }
    ?>

    </form>
    <?php echo '<br/><div class="message error">请先点击右下角的保存设置按钮，创建备份！<br/><br/><form class="backup" action="?calm_backup" method="post">
    <input type="submit" name="type" class="btn primary" value="创建备份" />
    <input type="submit" name="type" class="btn primary" value="还原备份" />
    <input type="submit" name="type" class="btn primary" value="删除备份" /></form></div>';
}
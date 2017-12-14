<?php
/*
 * @TODO 配置网站的固定信息
 * @TIME 2017-03-12
 */

require(__DIR__ . '/../../common/const/Const.php');

return [
    'user.passwordResetTokenExpire' => 3600,
    'adminEmail'                    => 'admin@example.com',
    'supportEmail'                  => 'support@example.com',
    'wechat_config'                 => [
        'app_id'      => 'wx435e8e396d1654d5',
        'token'      => '63d53045d928baacfaee7d4e2a9d9cfa',
        'aes_key'    => 'OsdGhIvf85kh2oBm4MrNHuufW3NaSqDE2k1YVDSWfoz',
        'app_secret' => 'eEOOWMpejIfede15rLe2IOuOfh0SGmtT',
    ],
];

/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : shop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-03-20 10:20:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `admin_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `addtime` int(10) NOT NULL,
  `ip` char(20) NOT NULL,
  `lasttime` int(10) NOT NULL,
  `sale` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1', 'admin', 'admin@12.com', '0c923b0bbb0147cbf5d26b41fd9f4d9b', '0', '127.0.0.1', '1550804247', '&GcoY');

-- ----------------------------
-- Table structure for tp_brand
-- ----------------------------
DROP TABLE IF EXISTS `tp_brand`;
CREATE TABLE `tp_brand` (
  `brand_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(30) NOT NULL,
  `brand_url` varchar(100) NOT NULL,
  `brand_logo` varchar(100) DEFAULT NULL,
  `brand_desc` varchar(200) DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0否1是',
  PRIMARY KEY (`brand_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_brand
-- ----------------------------
INSERT INTO `tp_brand` VALUES ('1', '家具', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('2', '小米', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('3', '淘宝', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('4', '360', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('5', '中兴', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('6', '金立', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('7', 'apple', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('8', 'oppo', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('9', 'vivo', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('10', '腾讯', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('11', '万维网', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('12', '精品服装', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('13', '新浪', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('14', '百度', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('15', '华为', 'http://www.baidu.com', 'https://www.baidu.com/img/bd_logo1.png?qua=high&where=super', '百度网站', '1');
INSERT INTO `tp_brand` VALUES ('18', '雅虎', 'asdfasf', '20190227\\e2fd5c9bb74e23ec8d48ee5fc4d27741.jpg', 'sdafadsf', '1');

-- ----------------------------
-- Table structure for tp_category
-- ----------------------------
DROP TABLE IF EXISTS `tp_category`;
CREATE TABLE `tp_category` (
  `cate_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(60) NOT NULL,
  `parent_id` int(8) NOT NULL DEFAULT '0',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1是 0 否',
  `is_nav_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1是0否',
  `keywords` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`cate_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_category
-- ----------------------------
INSERT INTO `tp_category` VALUES ('1', '男装', '0', '1', '1', '阿迪', '贵', '1552546917');
INSERT INTO `tp_category` VALUES ('2', '女装', '0', '1', '1', '六', '漂亮', '1552547129');
INSERT INTO `tp_category` VALUES ('3', '当季流行', '2', '1', '0', '春季', '奋斗', '1552547178');
INSERT INTO `tp_category` VALUES ('4', '精品上装', '2', '1', '0', '春季', '二分', '1552547227');
INSERT INTO `tp_category` VALUES ('5', '浪漫裙装', '2', '1', '0', '春季', '而非', '1552547254');
INSERT INTO `tp_category` VALUES ('6', '女士夏装', '2', '1', '0', '春季', '二分', '1552547296');
INSERT INTO `tp_category` VALUES ('7', '特殊女装', '2', '1', '0', '春季', '贰分', '1552547313');
INSERT INTO `tp_category` VALUES ('8', '当季流行', '1', '1', '0', '春季', '而纷纷', '1552547344');
INSERT INTO `tp_category` VALUES ('9', '运动鞋', '1', '1', '0', '嗯嗯嗯', '二分', '1552547552');
INSERT INTO `tp_category` VALUES ('10', '休闲男装', '1', '1', '1', '春季', '丰富', '1552547578');
INSERT INTO `tp_category` VALUES ('11', '帅气男装', '1', '1', '0', '饿v', '三个号', '1552547769');
INSERT INTO `tp_category` VALUES ('12', '奢侈品', '0', '1', '1', '春季', '丰富', '1552557979');
INSERT INTO `tp_category` VALUES ('13', '女士香水', '12', '1', '0', '额ef', '而纷纷', '1552558005');
INSERT INTO `tp_category` VALUES ('14', '男士香水', '12', '1', '0', '不v', '二分', '1552558034');
INSERT INTO `tp_category` VALUES ('15', '香奈儿邂逅清新淡香水', '13', '1', '0', '参数', '绑定', '1552558083');
INSERT INTO `tp_category` VALUES ('16', '迪奥香水2件套装', '13', '1', '0', '饿v不错', '方便电饭煲', '1552558133');
INSERT INTO `tp_category` VALUES ('17', '古龙水', '14', '1', '0', '单位非常', '完成vedv', '1552558176');
INSERT INTO `tp_category` VALUES ('18', '食品', '0', '1', '1', '额v', '代餐粉', '1552558326');
INSERT INTO `tp_category` VALUES ('19', '饮料', '18', '1', '0', '丰富', '大V', '1552558344');
INSERT INTO `tp_category` VALUES ('20', '零食', '18', '1', '0', '绑定', '不懂得', '1552558376');
INSERT INTO `tp_category` VALUES ('21', '虾兵蟹将', '20', '1', '0', '春季', '额', '1552558408');
INSERT INTO `tp_category` VALUES ('22', '冰红茶', '19', '1', '0', '阿迪', '丰富', '1552558439');
INSERT INTO `tp_category` VALUES ('23', '生鲜果蔬', '0', '1', '1', '否', '大V', '1552558482');
INSERT INTO `tp_category` VALUES ('24', '水果', '23', '1', '0', '春季', '奋斗', '1552558499');
INSERT INTO `tp_category` VALUES ('25', '蔬菜', '23', '1', '0', '飞科', 'fever', '1552558517');
INSERT INTO `tp_category` VALUES ('26', '海鲜', '23', '1', '0', '嗯嗯嗯', '测', '1552558658');
INSERT INTO `tp_category` VALUES ('27', '鲍鱼', '26', '1', '0', '飞科', 'favorite', '1552558673');
INSERT INTO `tp_category` VALUES ('28', '龙虾', '26', '1', '0', '六', '发v发v', '1552558691');
INSERT INTO `tp_category` VALUES ('29', '香蕉', '24', '1', '0', '阿迪', '绑定', '1552558706');
INSERT INTO `tp_category` VALUES ('30', '苹果', '24', '1', '0', '嗯嗯嗯', 'v啊', '1552558720');
INSERT INTO `tp_category` VALUES ('31', '小辣椒', '25', '1', '0', '嗯嗯嗯', '位发v', '1552558749');
INSERT INTO `tp_category` VALUES ('32', '洋葱', '25', '1', '0', '阿迪', 'v啊', '1552558808');
INSERT INTO `tp_category` VALUES ('33', '胡椒', '25', '1', '0', ' a', '啊v', '1552558833');
INSERT INTO `tp_category` VALUES ('34', '西服', '8', '1', '0', '春季', 'v', '1552559048');
INSERT INTO `tp_category` VALUES ('35', '阿迪', '8', '1', '0', '六', ' AV', '1552559074');
INSERT INTO `tp_category` VALUES ('36', '耐克', '9', '1', '0', '吧v ', 'v ', '1552559158');
INSERT INTO `tp_category` VALUES ('37', '李宁', '9', '1', '0', '吧擦', ' 啊', '1552559172');
INSERT INTO `tp_category` VALUES ('38', '新百伦', '9', '1', '0', 'v ', ' AV', '1552559191');
INSERT INTO `tp_category` VALUES ('39', '匹克', '9', '1', '0', '  v啊', 'v啊', '1552559209');
INSERT INTO `tp_category` VALUES ('40', '乔丹', '9', '1', '0', ' 啊 ', '啊啊', '1552559224');
INSERT INTO `tp_category` VALUES ('41', '百褶裙', '3', '1', '0', '阿迪', '从v', '1552559445');
INSERT INTO `tp_category` VALUES ('42', '结婚礼服', '7', '1', '0', '阿迪', ' 大V', '1552559493');
INSERT INTO `tp_category` VALUES ('43', '紧腿帅气男裤', '10', '1', '0', '嗯嗯嗯', ' 啊 ', '1552559546');
INSERT INTO `tp_category` VALUES ('44', '电器', '0', '1', '1', 'v ', ' 啊 ', '1552559799');
INSERT INTO `tp_category` VALUES ('45', '电脑', '44', '1', '0', '嗯嗯嗯', ' 啊', '1552559825');
INSERT INTO `tp_category` VALUES ('46', '家用电器', '44', '1', '0', ' 啊  ', '啊 ', '1552559859');
INSERT INTO `tp_category` VALUES ('47', '帅气工装', '11', '1', '0', ' 啊啊啊', ' 啊', '1552559901');
INSERT INTO `tp_category` VALUES ('48', '泳衣', '6', '1', '0', '   绑定v ', '安抚 ', '1552560043');
INSERT INTO `tp_category` VALUES ('49', '公主裙', '5', '1', '0', 'v  ', '啊', '1552560067');
INSERT INTO `tp_category` VALUES ('50', '手机', '44', '1', '0', '啊', '啊 ', '1552560142');
INSERT INTO `tp_category` VALUES ('51', '华为', '50', '1', '0', '吧擦', ' 啊 ', '1552560156');
INSERT INTO `tp_category` VALUES ('52', '三星', '50', '1', '0', '嗯嗯嗯和adv', 'v啊', '1552560171');
INSERT INTO `tp_category` VALUES ('53', '乐视', '50', '1', '0', ' 啊  ', ' 啊', '1552560189');
INSERT INTO `tp_category` VALUES ('54', '小米', '50', '1', '0', ' 啊 ', ' 啊', '1552560203');
INSERT INTO `tp_category` VALUES ('55', 'vivo', '50', '1', '0', 'v a ', ' a ', '1552560240');
INSERT INTO `tp_category` VALUES ('56', 'oppo', '50', '1', '0', '六', 'va ', '1552560271');
INSERT INTO `tp_category` VALUES ('57', '苹果', '50', '1', '0', ' 啊  ', 'AV', '1552560503');
INSERT INTO `tp_category` VALUES ('58', '魅族', '50', '1', '0', ' 啊  ', ' 啊', '1552560516');
INSERT INTO `tp_category` VALUES ('59', '电饭煲', '46', '1', '0', '阿迪', '擦', '1552560536');
INSERT INTO `tp_category` VALUES ('60', 'DELL', '45', '1', '0', ' 啊 ', ' 啊', '1552560553');
INSERT INTO `tp_category` VALUES ('61', '苹果', '45', '1', '0', '六Ave ', '啊', '1552560572');
INSERT INTO `tp_category` VALUES ('62', '热水壶', '46', '1', '0', '嗯嗯嗯', '啊', '1552560609');
INSERT INTO `tp_category` VALUES ('63', '反光外衣', '11', '1', '0', '阿迪', '阿福 ', '1552560637');
INSERT INTO `tp_category` VALUES ('64', '毛衣', '4', '1', '0', ' 啊 ', '发', '1552560665');
INSERT INTO `tp_category` VALUES ('65', '辣条', '20', '1', '0', 'v  ', ' 啊', '1552560705');
INSERT INTO `tp_category` VALUES ('66', '帆布鞋', '9', '1', '0', '嗯嗯嗯', '擦', '1552560735');
INSERT INTO `tp_category` VALUES ('67', '篮球鞋', '9', '1', '0', '嗯嗯嗯', '发', '1552560770');
INSERT INTO `tp_category` VALUES ('68', '足球鞋', '9', '1', '0', 'v  ', ' 啊', '1552560789');
INSERT INTO `tp_category` VALUES ('69', '清凉一夏套装', '10', '1', '0', '阿迪', '擦', '1552560856');
INSERT INTO `tp_category` VALUES ('70', '新西兰香水', '14', '1', '0', '嗯嗯嗯', '发v', '1552560896');
INSERT INTO `tp_category` VALUES ('71', '大闸蟹', '26', '1', '0', '嗯嗯嗯', 'vSD', '1552560916');
INSERT INTO `tp_category` VALUES ('72', '家具建材', '0', '1', '1', '阿迪', '阿女 ', '1552560982');
INSERT INTO `tp_category` VALUES ('73', '汽车', '0', '1', '1', '嗯嗯嗯', '啊 ', '1552560998');
INSERT INTO `tp_category` VALUES ('74', '医药保健', '0', '1', '1', '啊  ', '安保', '1552561055');
INSERT INTO `tp_category` VALUES ('75', '家坊and家饰', '0', '1', '1', '啊a', 'ava', '1552561116');
INSERT INTO `tp_category` VALUES ('77', '药品', '74', '1', '0', '嗯嗯嗯', '吧v', '1552561435');
INSERT INTO `tp_category` VALUES ('78', '吊灯', '75', '1', '0', '阿迪', '吧v', '1552561453');
INSERT INTO `tp_category` VALUES ('79', '国产汽车', '73', '1', '0', 'v ', '擦', '1552561477');
INSERT INTO `tp_category` VALUES ('80', '进口汽车', '73', '1', '0', '春季', '安保', '1552561495');
INSERT INTO `tp_category` VALUES ('81', '沙发', '72', '1', '0', '啊', '安保', '1552561510');
INSERT INTO `tp_category` VALUES ('82', '国产宝马', '79', '1', '0', '试试', '试试', '1552562248');
INSERT INTO `tp_category` VALUES ('83', '长安', '79', '1', '0', '水电费', '是的发v', '1552562338');
INSERT INTO `tp_category` VALUES ('89', '单人沙发', '81', '1', '0', '是的发v', '是的发v', '1552562801');
INSERT INTO `tp_category` VALUES ('88', '衣柜', '72', '1', '0', '否 dd', '大帅深V', '1552562746');
INSERT INTO `tp_category` VALUES ('87', '床', '72', '1', '0', '的风格吧', '反光VB', '1552562679');
INSERT INTO `tp_category` VALUES ('90', '懒人沙发', '81', '1', '0', '是的发v', '水电费VB', '1552562828');
INSERT INTO `tp_category` VALUES ('91', '法拉利', '80', '1', '0', '射得分', '地方VB', '1552562899');
INSERT INTO `tp_category` VALUES ('92', '双人床', '87', '1', '0', '春季', '嘻嘻嘻', '1552563001');
INSERT INTO `tp_category` VALUES ('93', '单人床', '87', '1', '0', '是大V', '的从v', '1552563026');
INSERT INTO `tp_category` VALUES ('94', '简易衣柜', '88', '1', '0', '地方VB', '发v', '1552563062');
INSERT INTO `tp_category` VALUES ('95', '感冒咳嗽', '77', '1', '0', '哦你结婚', '偶记', '1552563424');
INSERT INTO `tp_category` VALUES ('96', '保健品', '74', '1', '0', 'GV', 'v分工表', '1552563488');
INSERT INTO `tp_category` VALUES ('97', '胶原蛋白', '96', '1', '0', '家具', '一', '1552563583');
INSERT INTO `tp_category` VALUES ('98', '桌子', '75', '1', '0', '嗯嗯嗯', '发v', '1552563632');
INSERT INTO `tp_category` VALUES ('99', '窗帘', '75', '1', '0', '阿迪', '擦 ', '1552563651');
INSERT INTO `tp_category` VALUES ('100', '法式高脚', '78', '1', '0', '六', '发v', '1552611344');
INSERT INTO `tp_category` VALUES ('101', '红木桌', '98', '1', '0', '阿迪', '擦', '1552611374');
INSERT INTO `tp_category` VALUES ('102', '格子', '99', '1', '0', '额v', '额啊', '1552611454');

-- ----------------------------
-- Table structure for tp_friend
-- ----------------------------
DROP TABLE IF EXISTS `tp_friend`;
CREATE TABLE `tp_friend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_friend
-- ----------------------------
INSERT INTO `tp_friend` VALUES ('3', '京东', 'http://www.jd.com', '20190307\\ee325c677771b1fd988995ee93a0d22d.jpg', '1551940759');
INSERT INTO `tp_friend` VALUES ('4', '爱奇艺', 'http://www.aiqiyi.com', '20190307\\d22def6046490af227bd58af59a9386c.jpg', '1551940789');
INSERT INTO `tp_friend` VALUES ('7', '等等', 'http://sfsfsfs.com', '20190307\\57f098c245060c6f009626be6e7a92a9.jpg', '1551944025');

-- ----------------------------
-- Table structure for tp_goods
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods`;
CREATE TABLE `tp_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(120) NOT NULL,
  `cate_id` int(8) NOT NULL,
  `brand_id` int(8) NOT NULL,
  `goods_sn` varchar(100) NOT NULL,
  `shop_price` decimal(10,2) NOT NULL,
  `market_price` decimal(10,2) NOT NULL,
  `goods_img` varchar(120) DEFAULT NULL,
  `goods_thumb` varchar(120) DEFAULT NULL,
  `content` text,
  `goods_number` int(10) DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT '0' COMMENT '新品 1是 0否',
  `is_best` tinyint(1) DEFAULT '0' COMMENT '精品 1是 0否',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT '热销品 1是 0否',
  `is_on_sale` tinyint(1) DEFAULT '1' COMMENT '是否上下',
  `keywords` varchar(120) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`goods_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tp_goods
-- ----------------------------
INSERT INTO `tp_goods` VALUES ('1', '商务粉', '34', '12', 'ECS00001', '1245.00', '1300.00', '20190315\\e6ea5f7200e20f3b1a2648123f02814e.png', '20190315\\e6ea5f7200e20f3b1a2648123f02814e_thumb.png', null, '7', '1', '1', '1', '1', '春季', '饿v');
INSERT INTO `tp_goods` VALUES ('2', '红色', '36', '14', 'ECS00002', '5555.00', '6000.00', '20190315\\66e8ea2340fbe6ae2a6766ef859d002a.png', '20190315\\66e8ea2340fbe6ae2a6766ef859d002a_thumb.png', null, '5', '1', '1', '1', '1', '嗯嗯嗯', 'eaves');
INSERT INTO `tp_goods` VALUES ('3', '商务装', '43', '14', 'ECS00003', '200.00', '222.00', '20190315\\aa68541129eb1c0049ccedd7d9df744d.png', '20190315\\aa68541129eb1c0049ccedd7d9df744d_thumb.png', null, '10', '1', '1', '1', '1', '春季', '奥尔夫');
INSERT INTO `tp_goods` VALUES ('4', '帅气男裤', '36', '12', 'ECS00004', '1230.00', '1400.00', '20190315\\6ebc9a53449bdaf8077ee8aabe56dcb4.png', '20190315\\6ebc9a53449bdaf8077ee8aabe56dcb4_thumb.png', null, '22', '1', '1', '1', '1', '六', '饿啊');
INSERT INTO `tp_goods` VALUES ('5', '运动套装', '69', '12', 'ECS00005', '80.00', '100.00', '20190315\\40d609cf323326715590d1e302e15f01.png', '20190315\\40d609cf323326715590d1e302e15f01_thumb.png', null, '80', '1', '1', '1', '1', '阿迪', '发');
INSERT INTO `tp_goods` VALUES ('6', '足球网鞋', '36', '12', 'ECS00006', '9999.00', '11100.00', '20190315\\58a44a8f5f41c98d5cbd112f96c6dbcc.png', '20190315\\58a44a8f5f41c98d5cbd112f96c6dbcc_thumb.png', null, '5', '1', '1', '1', '1', '嗯嗯嗯', '阿飞');
INSERT INTO `tp_goods` VALUES ('7', '阿迪达斯', '35', '12', 'ECS00007', '300.00', '340.00', '20190315\\4eb7792668a32b2bc33baee196a059b4.png', '20190315\\4eb7792668a32b2bc33baee196a059b4_thumb.png', null, '8', '1', '1', '1', '1', '嗯嗯嗯', '阿飞');
INSERT INTO `tp_goods` VALUES ('8', '李宁男鞋', '37', '12', 'ECS00008', '321.00', '400.00', '20190315\\8a660ada63094566803988d5a4a51707.png', '20190315\\8a660ada63094566803988d5a4a51707_thumb.png', null, '19', '1', '1', '1', '1', '嗯嗯嗯', '阿飞');
INSERT INTO `tp_goods` VALUES ('9', '音速战靴', '37', '14', 'ECS00009', '400.00', '480.00', '20190315\\f0e1c613286ab4f98a47e9c8816b244a.png', '20190315\\f0e1c613286ab4f98a47e9c8816b244a_thumb.png', null, '5', '1', '1', '1', '1', '嗯嗯嗯', '阿飞');
INSERT INTO `tp_goods` VALUES ('10', '伊芙丽复古裙', '41', '10', 'ECS000010', '150.00', '200.00', '20190315\\955c098584fe4d71065f880bbeb4a7e1.png', '20190315\\955c098584fe4d71065f880bbeb4a7e1_thumb.png', null, '5', '1', '1', '1', '1', '阿迪', '饿v');
INSERT INTO `tp_goods` VALUES ('11', '复古版', '64', '14', 'ECS000011', '80.00', '120.00', '20190315\\32efa296317c268a2a3f2af2d5d57554.png', '20190315\\32efa296317c268a2a3f2af2d5d57554_thumb.png', null, '7', '1', '1', '1', '1', '六', '阿无色的风格');
INSERT INTO `tp_goods` VALUES ('12', '70ml瓶装', '17', '10', 'ECS000012', '500.00', '560.00', '20190315\\85ad5d3aa12e5af7ca999f90542767b8.png', '20190315\\85ad5d3aa12e5af7ca999f90542767b8_thumb.png', null, '22', '1', '1', '1', '1', ' 啊 ', '色胆如天一节课');
INSERT INTO `tp_goods` VALUES ('13', '高档婚纱', '42', '12', 'ECS000013', '2900.00', '3200.00', '20190315\\61a37ec52892a18318673ad2e2449016.png', '20190315\\61a37ec52892a18318673ad2e2449016_thumb.png', null, '3', '1', '1', '1', '1', '嗯嗯嗯', 'のvAV ');
INSERT INTO `tp_goods` VALUES ('14', '大嘴猴T恤', '64', '14', 'ECS000014', '199.00', '230.00', '20190315\\5c9bcd32c9c8300c0e638cb1924c87f2.png', '20190315\\5c9bcd32c9c8300c0e638cb1924c87f2_thumb.png', null, '6', '1', '1', '1', '1', '六', '额在vz');
INSERT INTO `tp_goods` VALUES ('15', '破洞牛仔外套', '64', '12', 'ECS000015', '299.80', '321.00', '20190315\\1a7478abb68309c0036277a5dde975dc.png', '20190315\\1a7478abb68309c0036277a5dde975dc_thumb.png', null, '5', '1', '1', '1', '1', '阿迪', '儿女');
INSERT INTO `tp_goods` VALUES ('16', '休闲牛仔', '49', '12', 'ECS000016', '449.00', '500.00', '20190315\\7b8013ca36666f73e6e45f3a0b338946.png', '20190315\\7b8013ca36666f73e6e45f3a0b338946_thumb.png', null, '9', '1', '1', '1', '1', '六', '饿v');
INSERT INTO `tp_goods` VALUES ('17', '复古连衣裙', '49', '14', 'ECS000017', '6666.00', '7000.00', '20190315\\292e87d5de54e71549ee2ce39daec5e5.png', '20190315\\292e87d5de54e71549ee2ce39daec5e5_thumb.png', null, '554', '1', '1', '1', '1', '嗯嗯嗯', '儿童');
INSERT INTO `tp_goods` VALUES ('19', '浪漫婚纱', '42', '12', 'ECS000019', '9999.00', '10010.00', '20190315\\0ff97bba0e32b4f6dd47dbcd25207ffc.png', '20190315\\0ff97bba0e32b4f6dd47dbcd25207ffc_thumb.png', null, '3', '1', '1', '1', '1', '春季', '而发v');
INSERT INTO `tp_goods` VALUES ('20', '祖玛珑 蓝风铃香型', '15', '12', 'ECS000020', '600.00', '666.00', '20190315\\71349b2433ba0da472667fe328afd8e3.png', '20190315\\71349b2433ba0da472667fe328afd8e3_thumb.png', null, '55', '1', '1', '1', '1', ' 啊 ', '玩儿推理');
INSERT INTO `tp_goods` VALUES ('21', '范思哲 晶钻女用香水', '16', '12', 'ECS000021', '259.00', '300.00', '20190315\\f58035d8a0aadb0b0e296c1d0f1b8ff7.png', '20190315\\f58035d8a0aadb0b0e296c1d0f1b8ff7_thumb.png', null, '22', '1', '1', '1', '1', 'fever', '温度fvz');
INSERT INTO `tp_goods` VALUES ('23', '古奇 罪爱女士淡香水', '15', '14', 'ECS000023', '369.00', '400.00', '20190315\\65964592e8d75c9bda23bc04b96ed369.png', '20190315\\65964592e8d75c9bda23bc04b96ed369_thumb.png', null, '22', '1', '1', '1', '1', '阿迪', '对方过后就');
INSERT INTO `tp_goods` VALUES ('24', '安娜苏 筑梦天马淡香水', '16', '12', 'ECS000024', '415.00', '460.00', '20190315\\0e37ee789c11fecdcca3de44d43a704c.png', '20190315\\0e37ee789c11fecdcca3de44d43a704c_thumb.png', null, '54', '1', '1', '1', '1', '六', '3请为地方官府菜');
INSERT INTO `tp_goods` VALUES ('25', '迪奥小姐花漾淡香', '15', '12', 'ECS000025', '1019.00', '1200.00', '20190315\\bd9bb362291f28a3be3ae038bc9837db.png', '20190315\\bd9bb362291f28a3be3ae038bc9837db_thumb.png', null, '52', '1', '1', '1', '1', '大V在', '大V在');
INSERT INTO `tp_goods` VALUES ('26', '纪梵希 灿若晨曦浓香氛', '16', '14', 'ECS000026', '630.00', '649.00', '20190315\\8215d7965f4c2bb90be38d23ce8cac74.png', '20190315\\8215d7965f4c2bb90be38d23ce8cac74_thumb.png', null, '12', '1', '1', '1', '1', '而发v非常', '恶女c');
INSERT INTO `tp_goods` VALUES ('29', '创实 柠檬红茶粉 速溶冻柠茶原料 冰红', '22', '14', 'ECS000029', '25.80', '30.00', '20190315\\634036eab4905224e16a7a67a6aa0554.png', '20190315\\634036eab4905224e16a7a67a6aa0554_thumb.png', null, '54345', '1', '1', '1', '1', ' 啊 ', '俄女子');
INSERT INTO `tp_goods` VALUES ('30', '娇兰 小黑裙淡香水', '16', '14', 'ECS000030', '745.00', '768.00', '20190315\\961fd04c0bd0ff10bd81a23bbb6fb538.png', '20190315\\961fd04c0bd0ff10bd81a23bbb6fb538_thumb.png', null, '542', '1', '1', '1', '1', '六', '擦房地产');
INSERT INTO `tp_goods` VALUES ('31', '进口玉米', '21', '14', 'ECS000031', '40.00', '53.00', '20190316\\8b7286402c201f73ee8d0d04d31f5470.png', '20190316\\8b7286402c201f73ee8d0d04d31f5470_thumb.png', null, '345', '1', '1', '1', '1', '额vgre', '个红包呢');
INSERT INTO `tp_goods` VALUES ('32', '盼盼法式小面包', '21', '12', 'ECS000032', '20.00', '30.00', '20190316\\106d33a3e2a54e77657f6ca31655796e.png', '20190316\\106d33a3e2a54e77657f6ca31655796e_thumb.png', null, '542', '1', '1', '1', '1', '春季', '土库曼导航');
INSERT INTO `tp_goods` VALUES ('33', '大白兔奶糖', '21', '10', 'ECS000033', '50.00', '60.00', '20190316\\59efec8ae17a903efe46aa5bc91de748.png', '20190316\\59efec8ae17a903efe46aa5bc91de748_thumb.png', null, '52', '1', '1', '1', '1', ' 规范', '  res认识');
INSERT INTO `tp_goods` VALUES ('34', '小当家', '21', '10', 'ECS000034', '12.00', '20.00', '20190316\\a8887d9b735beddb09df8954e6b2a8b0.png', '20190316\\a8887d9b735beddb09df8954e6b2a8b0_thumb.png', null, '83678', '1', '1', '1', '1', '7', '和太阳能');
INSERT INTO `tp_goods` VALUES ('35', '三只松鼠吐司面包', '21', '14', 'ECS000035', '50.00', '76.00', '20190316\\049c466b64719663e513e1299419ab95.png', '20190316\\049c466b64719663e513e1299419ab95_thumb.png', null, '455', '1', '1', '1', '1', '吧v ', '而非VBv ');
INSERT INTO `tp_goods` VALUES ('36', '牛肉干', '21', '12', 'ECS000036', '78.00', '99.00', '20190316\\a68560c37636b66992981e405d631863.png', '20190316\\a68560c37636b66992981e405d631863_thumb.png', null, '2415', '1', '1', '1', '1', '阿迪', '玩儿更换');
INSERT INTO `tp_goods` VALUES ('37', '旺仔小奶糖', '21', '12', 'ECS000037', '20.00', '36.00', '20190316\\342d9082185347cfb3479f8daac66897.png', '20190316\\342d9082185347cfb3479f8daac66897_thumb.png', null, '786335', '1', '1', '1', '1', '嗯嗯嗯', '个人头水泥');
INSERT INTO `tp_goods` VALUES ('38', '整盒虾鲜活海鲜水产超大虾基围虾活虾', '28', '10', 'ECS000038', '129.00', '130.00', '20190316\\831525cfee8f2b8d93a7797da631749a.png', '20190316\\831525cfee8f2b8d93a7797da631749a_thumb.png', null, '453', '1', '1', '1', '1', '春季', '而发v');
INSERT INTO `tp_goods` VALUES ('39', '海洋岛5斤大连新鲜大生蚝鲜活带壳牡', '27', '14', 'ECS000039', '99.00', '120.00', '20190316\\dd6a9f8015ffb522a28058ee554906f0.png', '20190316\\dd6a9f8015ffb522a28058ee554906f0_thumb.png', null, '124', '1', '1', '1', '1', '六', '二分 ');
INSERT INTO `tp_goods` VALUES ('40', '章鱼生鲜海鲜水产鲜活八爪鱼深海墨鱼', '27', '14', 'ECS000040', '69.00', '84.00', '20190316\\413cf360000fc3f56f90773aa639795b.png', '20190316\\413cf360000fc3f56f90773aa639795b_thumb.png', null, '452', '1', '1', '1', '1', '个', '3二个人好疼吧v');
INSERT INTO `tp_goods` VALUES ('41', '晓芹海参 大连晓芹即食海参 冷冻即食', '28', '12', 'ECS000041', '1300.00', '1500.00', '20190316\\b02ac4cec2c156647777294f1f191ed6.png', '20190316\\b02ac4cec2c156647777294f1f191ed6_thumb.png', null, '151', '1', '1', '1', '1', '饿v', '3(⊙o⊙)…肉骨粉VC');
INSERT INTO `tp_goods` VALUES ('42', '鱼肉干', '27', '14', 'ECS000042', '241.00', '290.00', '20190316\\c7b80cca88a1095886f525da10fb7625.png', '20190316\\c7b80cca88a1095886f525da10fb7625_thumb.png', null, '1451', '1', '1', '1', '1', '阿迪', '345他问你个');
INSERT INTO `tp_goods` VALUES ('43', '南美虾仁冷冻新鲜青虾仁鲜冻速冻白大虾', '28', '12', 'ECS000043', '153.00', '200.00', '20190316\\1bf90baf4c353f6c67cc0352a3b380c9.png', '20190316\\1bf90baf4c353f6c67cc0352a3b380c9_thumb.png', null, '14020', '1', '1', '1', '1', '34人', '3腿个人太过分');
INSERT INTO `tp_goods` VALUES ('44', '深海野生海鲜梅香永昊马鲛鱼片马交鱼切', '27', '14', 'ECS000044', '49.00', '56.00', '20190316\\8e79e7f63dc9002ff605541ed783311e.png', '20190316\\8e79e7f63dc9002ff605541ed783311e_thumb.png', null, '5434', '1', '1', '1', '1', '六', '34托管人不');
INSERT INTO `tp_goods` VALUES ('45', '臭鳜鱼黄山特产臭鲑鱼净膛去腮去鳞真空', '27', '12', 'ECS000045', '145.00', '210.00', '20190316\\7b0e59dbdf13ee0c765f8837cd9e19eb.png', '20190316\\7b0e59dbdf13ee0c765f8837cd9e19eb_thumb.png', null, '724', '1', '1', '1', '1', '嗯嗯嗯', '34全员和我特别f');
INSERT INTO `tp_goods` VALUES ('46', '吸尘器', '62', '12', 'ECS000046', '400.00', '451.00', '20190316\\2db903618b7a39a56bd64d7da4230423.png', '20190316\\2db903618b7a39a56bd64d7da4230423_thumb.png', null, '151', '1', '1', '1', '1', '六', '34肉骨粉是');
INSERT INTO `tp_goods` VALUES ('47', '宁美国度i5 8500GTX1050Ti台式吃鸡', '61', '12', 'ECS000047', '3999.00', '4120.00', '20190316\\6284f3c0ec30fa985eaec7701e055ec8.png', '20190316\\6284f3c0ec30fa985eaec7701e055ec8_thumb.png', null, '442', '1', '1', '1', '1', '六', '二哥吧');
INSERT INTO `tp_goods` VALUES ('48', '飞利浦 FC6409', '62', '14', 'ECS000048', '1952.00', '2017.00', '20190316\\9289c6f78121e228434ce12d57715f81.png', '20190316\\9289c6f78121e228434ce12d57715f81_thumb.png', null, '14', '1', '1', '1', '1', '阿迪', '3(⊙o⊙)…容合同文本认购');
INSERT INTO `tp_goods` VALUES ('49', '联想 拯救者', '60', '12', 'ECS000049', '5999.00', '6241.00', '20190316\\5d27869d0d0c9c7546e64e1105e8a65f.png', '20190316\\5d27869d0d0c9c7546e64e1105e8a65f_thumb.png', null, '51', '1', '1', '1', '1', '嗯嗯嗯', '二部删除');
INSERT INTO `tp_goods` VALUES ('50', '九阳', '59', '12', 'ECS000050', '450.00', '310.00', '20190316\\6252e28b51b8b16033091ca94b9108c1.png', '20190316\\6252e28b51b8b16033091ca94b9108c1_thumb.png', null, '15', '1', '1', '1', '1', '嗯嗯嗯', '34抢人头哺乳纲s');
INSERT INTO `tp_goods` VALUES ('51', 'i7高配吃鸡游戏电脑主机组装台式电', '60', '12', 'ECS000051', '1999.00', '2100.00', '20190316\\7ebe3dceed798d06ab83f9e72f74b5b7.png', '20190316\\7ebe3dceed798d06ab83f9e72f74b5b7_thumb.png', null, '545', '1', '1', '1', '1', ' 啊 ', '二部想');
INSERT INTO `tp_goods` VALUES ('52', '联想IdeaPad3302018款笔记', '60', '12', 'ECS000052', '3999.00', '4210.00', '20190316\\b8f98efe7803f4a60263e9f917bdbcbf.png', '20190316\\b8f98efe7803f4a60263e9f917bdbcbf_thumb.png', null, '5', '1', '1', '1', '1', '春季', '34人');
INSERT INTO `tp_goods` VALUES ('53', '华硕飞行堡垒6 i7GTX1050Ti1', '60', '9', 'ECS000053', '7999.00', '8210.00', '20190316\\c2574ef7d832b1c8fd70c1f0ff672f62.png', '20190316\\c2574ef7d832b1c8fd70c1f0ff672f62_thumb.png', null, '215', '1', '1', '1', '1', '春季', '3儿童办公室否');
INSERT INTO `tp_goods` VALUES ('54', '老板椅', '89', '4', 'ECS000054', '300.00', '410.00', '20190319\\68fa37ed75b3e9a1691ef5fa3327bcf3.png', '20190319\\68fa37ed75b3e9a1691ef5fa3327bcf3_thumb.png', null, '21', '1', '1', '1', '1', '破', '体育界和');
INSERT INTO `tp_goods` VALUES ('55', '古风床', '92', '13', 'ECS000055', '1500.00', '1700.00', '20190319\\bc734a66c7cddcc2979ba04356b4dc73.png', '20190319\\bc734a66c7cddcc2979ba04356b4dc73_thumb.png', null, '21', '1', '1', '1', '1', '嗯嗯嗯', '而法国');
INSERT INTO `tp_goods` VALUES ('56', '休闲家居', '89', '1', 'ECS000056', '410.00', '580.00', '20190319\\ae1c36f07841aeea625335459d158c90.png', '20190319\\ae1c36f07841aeea625335459d158c90_thumb.png', null, '121', '1', '1', '1', '1', ' 啊  ', '人否');
INSERT INTO `tp_goods` VALUES ('57', '贵族餐桌', '89', '1', 'ECS000057', '7000.00', '8100.00', '20190319\\01b74669e48f5b8614d97d0897b1de94.png', '20190319\\01b74669e48f5b8614d97d0897b1de94_thumb.png', null, '12', '1', '1', '1', '1', '春季', '3而且发大V');
INSERT INTO `tp_goods` VALUES ('58', '个性沙发', '89', '1', 'ECS000058', '3222.00', '4212.00', '20190319\\12f54bfdfeb4f511e24b349761311a55.png', '20190319\\12f54bfdfeb4f511e24b349761311a55_thumb.png', null, '4', '1', '1', '1', '1', '嗯嗯嗯', '32我二哥发v从');
INSERT INTO `tp_goods` VALUES ('59', '复古版沙发', '90', '3', 'ECS000059', '52411.00', '60000.00', '20190319\\7552e15034a02b787b8af778735ce4a1.png', '20190319\\7552e15034a02b787b8af778735ce4a1_thumb.png', null, '12', '1', '1', '1', '1', '嗯嗯嗯', '二分过滤池');
INSERT INTO `tp_goods` VALUES ('60', '原木厨桌', '94', '11', 'ECS000060', '1452.00', '1921.00', '20190319\\d8889bc56331471d595c40c166888c70.png', '20190319\\d8889bc56331471d595c40c166888c70_thumb.png', null, '123', '1', '1', '1', '1', '春季', '34个人版否');
INSERT INTO `tp_goods` VALUES ('61', '浪漫婚床', '92', '0', 'ECS000061', '50000.00', '64120.00', '20190319\\ccbb048c9d852b528d26f9ee3d2604de.png', '20190319\\ccbb048c9d852b528d26f9ee3d2604de_thumb.png', null, '2', '1', '1', '1', '1', '春季', '恶女方肚子');

-- ----------------------------
-- Table structure for tp_goods_photo
-- ----------------------------
DROP TABLE IF EXISTS `tp_goods_photo`;
CREATE TABLE `tp_goods_photo` (
  `photo_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(8) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`photo_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tp_goods_photo
-- ----------------------------
INSERT INTO `tp_goods_photo` VALUES ('7', '20', '20190304\\799610dbf5d0a7f2f7a78866938f9d88.jpg');
INSERT INTO `tp_goods_photo` VALUES ('8', '20', '20190304\\e76e22924cdea5e5d5261ee806def272.jpg');
INSERT INTO `tp_goods_photo` VALUES ('16', '24', '20190305\\6d4b14e385c7be2a598f4aab26e4a40f.jpg');
INSERT INTO `tp_goods_photo` VALUES ('17', '24', '20190305\\bec0534b00a29f3bb9a0067a15434b73.jpg');
INSERT INTO `tp_goods_photo` VALUES ('18', '24', '20190305\\bbf9ef56cfd4055c5eac1563191d2ace.jpg');
INSERT INTO `tp_goods_photo` VALUES ('19', '22', '20190307\\daa0199f7282d10db5293da089cfe040.jpg');
INSERT INTO `tp_goods_photo` VALUES ('20', '22', '20190307\\5f1cc467d251ad1f2601beb80cd0fcf6.png');
INSERT INTO `tp_goods_photo` VALUES ('21', '22', '20190307\\7607434e1f148b0c3235fd1a27da13be.jpg');
INSERT INTO `tp_goods_photo` VALUES ('22', '23', '20190307\\597ea52598611d4f34319f80359fcf2b.jpg');
INSERT INTO `tp_goods_photo` VALUES ('23', '23', '20190307\\235d942c49005dfe438365f58583fe95.jpg');
INSERT INTO `tp_goods_photo` VALUES ('24', '23', '20190307\\a9cd2ed962271b030c5ff8bdd1d0485d.png');
INSERT INTO `tp_goods_photo` VALUES ('25', '24', '20190307\\e19de45f4e1c3faab5beacb4c96a8624.jpg');
INSERT INTO `tp_goods_photo` VALUES ('26', '24', '20190307\\1ed7a97cd32f01018ec5c72e0e1bc681.jpg');
INSERT INTO `tp_goods_photo` VALUES ('27', '24', '20190307\\110ff692da7dfe3cd485e161aa90eaa4.jpg');
INSERT INTO `tp_goods_photo` VALUES ('28', '24', '20190307\\297bf3889abc4b2853481a478298da42.jpg');
INSERT INTO `tp_goods_photo` VALUES ('29', '24', '20190307\\4a718ada464f8f074385834240390924.jpg');
INSERT INTO `tp_goods_photo` VALUES ('30', '24', '20190307\\3cce22c1fb6734a1053d79ddebc7dce0.png');
INSERT INTO `tp_goods_photo` VALUES ('31', '1', '20190315\\560f0d88de4add09ec9343ccbeb31804.jpg');
INSERT INTO `tp_goods_photo` VALUES ('32', '1', '20190315\\7cdd42ac3d4c853b7ff37ac1faff4fcc.jpeg');
INSERT INTO `tp_goods_photo` VALUES ('33', '1', '20190315\\7650eab1ad80b98a1514908cc4bcd7cc.jpg');
INSERT INTO `tp_goods_photo` VALUES ('34', '2', '20190315\\21627c168d9b6f3475936551a224e486.jpg');
INSERT INTO `tp_goods_photo` VALUES ('35', '2', '20190315\\62ec2635f959fa7ba8874365c1b2fff5.jpeg');
INSERT INTO `tp_goods_photo` VALUES ('36', '2', '20190315\\ef492ccf2df5e5d499b498af546cdec1.jpg');
INSERT INTO `tp_goods_photo` VALUES ('37', '3', '');
INSERT INTO `tp_goods_photo` VALUES ('38', '4', '20190315\\72dde3c968e5e473bf4bdf8092ab5e90.jpeg');
INSERT INTO `tp_goods_photo` VALUES ('39', '4', '20190315\\e93c41c968554248d95e44a9b9d75ae6.jpg');
INSERT INTO `tp_goods_photo` VALUES ('40', '4', '20190315\\1e50355c8905c71afbf20f5461cff67e.jpg');
INSERT INTO `tp_goods_photo` VALUES ('41', '5', '20190315\\f62efe08fcf12f7ed8eca64dc4f496f7.jpeg');
INSERT INTO `tp_goods_photo` VALUES ('42', '5', '20190315\\7f742bd410e8992cc015372abf0a6f97.jpg');
INSERT INTO `tp_goods_photo` VALUES ('43', '5', '20190315\\aeb0ce661ca1d7d31b401280c35bd67b.jpg');
INSERT INTO `tp_goods_photo` VALUES ('44', '5', '20190315\\ea5969f1d2868b4d4723ee4724b61874.jpeg');
INSERT INTO `tp_goods_photo` VALUES ('45', '1', '20190315\\4eb09cd25e9be84b9bbe717f1dad64e1.png');
INSERT INTO `tp_goods_photo` VALUES ('46', '2', '');
INSERT INTO `tp_goods_photo` VALUES ('47', '1', '20190315\\9bb4f134a62db88e98b3159815001b4a.png');
INSERT INTO `tp_goods_photo` VALUES ('48', '2', '20190315\\bc673bbfe6ae3f8f973811a651dfe70d.png');
INSERT INTO `tp_goods_photo` VALUES ('49', '3', '20190315\\718a787674e4cc9a351e741324b05d25.png');
INSERT INTO `tp_goods_photo` VALUES ('50', '4', '20190315\\70ffe664f1b1bf28a7b0b8fd0fb15f6a.png');
INSERT INTO `tp_goods_photo` VALUES ('51', '5', '20190315\\9db37e64d82667b0920fd8c81170de7f.png');
INSERT INTO `tp_goods_photo` VALUES ('52', '6', '20190315\\a4b4bde8347656474a40f6d078f938e5.png');
INSERT INTO `tp_goods_photo` VALUES ('53', '7', '20190315\\184f14f1f2f23d25beecfcc8384768e6.png');
INSERT INTO `tp_goods_photo` VALUES ('54', '8', '20190315\\02497dc3a6f211bab308871b2074aa45.png');
INSERT INTO `tp_goods_photo` VALUES ('55', '9', '20190315\\6fb7f6df6cc4372209aec2297d7569dd.png');
INSERT INTO `tp_goods_photo` VALUES ('56', '10', '20190315\\fab89e88ee31f1e09db067820369d133.png');
INSERT INTO `tp_goods_photo` VALUES ('57', '11', '20190315\\f7bb930a4315ecff7ad14261a24a9b43.png');
INSERT INTO `tp_goods_photo` VALUES ('58', '12', '20190315\\ae8d357a7867d2f97ebc63f6835366f0.png');
INSERT INTO `tp_goods_photo` VALUES ('59', '13', '20190315\\61f715081527c9c2fb3735eed6e21204.png');
INSERT INTO `tp_goods_photo` VALUES ('60', '14', '20190315\\68fcc13224bb93de174f8eedb83e3a09.png');
INSERT INTO `tp_goods_photo` VALUES ('61', '15', '20190315\\36728e810958b25b2749af0588e2550e.png');
INSERT INTO `tp_goods_photo` VALUES ('62', '16', '20190315\\109c039ef3e84a25218255aacebd03d6.png');
INSERT INTO `tp_goods_photo` VALUES ('63', '17', '20190315\\076a9e905c684c4031f45892d101036e.png');
INSERT INTO `tp_goods_photo` VALUES ('64', '17', '20190315\\3d99f8e38beec68252918ddffbaed54d.png');
INSERT INTO `tp_goods_photo` VALUES ('65', '18', '20190315\\076a9e905c684c4031f45892d101036e.png');
INSERT INTO `tp_goods_photo` VALUES ('66', '18', '20190315\\3d99f8e38beec68252918ddffbaed54d.png');
INSERT INTO `tp_goods_photo` VALUES ('67', '19', '20190315\\49d8d8090e9e2e31e4bad5bd479577ca.png');
INSERT INTO `tp_goods_photo` VALUES ('68', '20', '20190315\\30e661e3b463b832920ab8b00ddc4570.png');
INSERT INTO `tp_goods_photo` VALUES ('69', '21', '20190315\\e1b8bb3638bc714ccd78e99e99a35e5d.png');
INSERT INTO `tp_goods_photo` VALUES ('70', '22', '20190315\\e1b8bb3638bc714ccd78e99e99a35e5d.png');
INSERT INTO `tp_goods_photo` VALUES ('71', '23', '20190315\\6cdad9e574d7f3d896d6cfd4d4c7c038.png');
INSERT INTO `tp_goods_photo` VALUES ('72', '24', '20190315\\813b5e2ea73224eaf4caebc5fdf94a61.png');
INSERT INTO `tp_goods_photo` VALUES ('73', '25', '20190315\\4b5f007d372e7dfcd556081f9830dc58.png');
INSERT INTO `tp_goods_photo` VALUES ('74', '26', '20190315\\7bca5e0612d721583aca52996fcadeb4.png');
INSERT INTO `tp_goods_photo` VALUES ('75', '27', '20190315\\7bca5e0612d721583aca52996fcadeb4.png');
INSERT INTO `tp_goods_photo` VALUES ('76', '28', '20190315\\8ecf18ad5b35ccd14460189f2db36f01.png');
INSERT INTO `tp_goods_photo` VALUES ('77', '29', '20190315\\54da11f7754ef65330ea6a5f15100a4e.png');
INSERT INTO `tp_goods_photo` VALUES ('78', '30', '20190315\\add4d46a186e7062a166841e7a6e9e32.png');
INSERT INTO `tp_goods_photo` VALUES ('79', '31', '');
INSERT INTO `tp_goods_photo` VALUES ('80', '32', '20190316\\0ed1a5ebfb24d39ef9158b51f459fb0f.png');
INSERT INTO `tp_goods_photo` VALUES ('81', '33', '20190316\\85e05bb46e46330a0eb78894f9c00a30.png');
INSERT INTO `tp_goods_photo` VALUES ('82', '34', '20190316\\1fb3c7e3349a44c85dc6c0e0317f3223.png');
INSERT INTO `tp_goods_photo` VALUES ('83', '35', '20190316\\44dfb4882318a8cf406a79c036bb2e64.png');
INSERT INTO `tp_goods_photo` VALUES ('84', '36', '20190316\\08f5fb43ca59f41bbbfb631865ab8749.png');
INSERT INTO `tp_goods_photo` VALUES ('85', '37', '20190316\\78840d930cbbad8b47f50f6a91c65e0c.png');
INSERT INTO `tp_goods_photo` VALUES ('86', '38', '20190316\\f3133295b695004c58e6a6cfc8066c65.png');
INSERT INTO `tp_goods_photo` VALUES ('87', '39', '20190316\\fcec12d60ef7632a28530ae4e4f03a47.png');
INSERT INTO `tp_goods_photo` VALUES ('88', '40', '20190316\\74ad03523e01fbc99596316d5c788b10.png');
INSERT INTO `tp_goods_photo` VALUES ('89', '41', '20190316\\d3aeec16d7d759c6eec1c2cb3c01fca2.png');
INSERT INTO `tp_goods_photo` VALUES ('90', '42', '20190316\\5107231b565d02fc2d71176221e07cd0.png');
INSERT INTO `tp_goods_photo` VALUES ('91', '43', '20190316\\b82226327f217f6b49834883cb92ffda.png');
INSERT INTO `tp_goods_photo` VALUES ('92', '44', '20190316\\b070d52a4c7b2134109945dc989283b5.png');
INSERT INTO `tp_goods_photo` VALUES ('93', '45', '20190316\\0ca267eb6997c2bff5a83cae43a335e8.png');
INSERT INTO `tp_goods_photo` VALUES ('94', '46', '20190316\\52872b933efc07f227af977e4cd8207d.png');
INSERT INTO `tp_goods_photo` VALUES ('95', '47', '20190316\\3fdab4ab38aac499774dbaf057868924.png');
INSERT INTO `tp_goods_photo` VALUES ('96', '48', '20190316\\336b61e56f43e6ed6dbb0ab51937438c.png');
INSERT INTO `tp_goods_photo` VALUES ('97', '49', '20190316\\f380455cb38bcc4a670b74d88359fa03.png');
INSERT INTO `tp_goods_photo` VALUES ('98', '50', '20190316\\8fe1a2a803bf96f785afde8e582b8b60.png');
INSERT INTO `tp_goods_photo` VALUES ('99', '51', '20190316\\6cc710ee82b8a96adb6e889e6bf4f9ce.png');
INSERT INTO `tp_goods_photo` VALUES ('100', '52', '20190316\\4e4bdce48e0f4a198899e90af26b23dd.png');
INSERT INTO `tp_goods_photo` VALUES ('101', '53', '20190316\\d31d60a2a64fcc67f477b3894cd5777f.png');
INSERT INTO `tp_goods_photo` VALUES ('102', '54', '20190319\\f76a994695075a14316652f5f5746040.png');
INSERT INTO `tp_goods_photo` VALUES ('103', '55', '20190319\\3380e277bedf7d72fd0dbbd08626f4c9.png');
INSERT INTO `tp_goods_photo` VALUES ('104', '56', '20190319\\06a4ed64800b09bdac9ab258b2a8c12c.png');
INSERT INTO `tp_goods_photo` VALUES ('105', '57', '20190319\\004fa28655550612dea47fb56f8b2427.png');
INSERT INTO `tp_goods_photo` VALUES ('106', '58', '20190319\\b83da10a04a6959d8742552df7497add.png');
INSERT INTO `tp_goods_photo` VALUES ('107', '59', '20190319\\ce5425ae8bc2f9c5d9172960e2ac637e.png');
INSERT INTO `tp_goods_photo` VALUES ('108', '60', '20190319\\31a1e06f598b9b94cacc1a648ecd32cc.png');
INSERT INTO `tp_goods_photo` VALUES ('109', '61', '20190319\\79477eda945b8f93d9896e1a0dcac991.png');

-- ----------------------------
-- Table structure for tp_menu
-- ----------------------------
DROP TABLE IF EXISTS `tp_menu`;
CREATE TABLE `tp_menu` (
  `menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) NOT NULL,
  `parent_id` tinyint(2) NOT NULL DEFAULT '0',
  `model` varchar(20) NOT NULL,
  `controller` varchar(20) NOT NULL,
  `method` varchar(20) NOT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_menu
-- ----------------------------
INSERT INTO `tp_menu` VALUES ('1', '商品管理', '0', 'admin', 'menu', 'add');
INSERT INTO `tp_menu` VALUES ('2', '第二即', '1', 'admin', 'menu', 'add');
INSERT INTO `tp_menu` VALUES ('3', '第三', '1', 'admin', 'menu', 'add');
INSERT INTO `tp_menu` VALUES ('5', '菜单搜索', '3', 'sdsd', 'ddd', 'fsds');
INSERT INTO `tp_menu` VALUES ('6', '第三方', '1', 'dsd', 'ds', 'ds');

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `u_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_email` varchar(35) NOT NULL,
  `u_pwd` varchar(32) NOT NULL,
  `u_phone` varchar(20) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `u_code` char(6) DEFAULT NULL,
  `last_error_time` int(11) DEFAULT NULL,
  `error_num` int(3) DEFAULT '0',
  PRIMARY KEY (`u_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('1', '1501826367@qq.com', '96e79218965eb72c92a549dd5a330112', '', '1552456008', '989583', null, '0');
INSERT INTO `tp_user` VALUES ('2', '18360176323@163.com', 'e3ceb5881a0a1fdaad01296d7554868d', '', '1552459739', '614474', null, '0');

-- ----------------------------
-- Table structure for tp_users
-- ----------------------------
DROP TABLE IF EXISTS `tp_users`;
CREATE TABLE `tp_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_desc` text,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_users
-- ----------------------------
INSERT INTO `tp_users` VALUES ('2', '张三的撒旦', '但是大是大非');
INSERT INTO `tp_users` VALUES ('4', '四大佛山', '反倒是公司的个首付大概师傅第敢死队');
INSERT INTO `tp_users` VALUES ('9', '李四', '得瑟得瑟 ');
INSERT INTO `tp_users` VALUES ('5', '登封市', '发多少个挂号费解放后第三方的风格岁的法国撒旦岁的法国第三方');
INSERT INTO `tp_users` VALUES ('6', '王五', '  回到房间返回夫公爵草根达人 是的');
INSERT INTO `tp_users` VALUES ('7', '法国德国但是', '发多少个岁的法国岁的法国撒地方阀手动法国撒');
INSERT INTO `tp_users` VALUES ('8', '撒地方s', ' 是否广大撒旦撒旦 ');

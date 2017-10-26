-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2012 年 10 月 22 日 11:12
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `demo-l1`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `backmenu`
-- 

CREATE TABLE `backmenu` (
  `id_backmenu` int(11) NOT NULL auto_increment,
  `lang` int(1) NOT NULL default '1',
  `name` varchar(25) NOT NULL,
  `remark` text NOT NULL,
  `url` varchar(100) NOT NULL,
  `fatherid` int(11) NOT NULL,
  `level` int(1) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `dele` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id_backmenu`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

-- 
-- 导出表中的数据 `backmenu`
-- 

INSERT INTO `backmenu` VALUES (1, 1, '产品系统', '', 'product', 0, 1, 2, 1);
INSERT INTO `backmenu` VALUES (3, 1, '信息系统', '', 'news', 0, 1, 3, 1);
INSERT INTO `backmenu` VALUES (4, 1, '人事系统', '', 'hr', 0, 1, 4, 1);
INSERT INTO `backmenu` VALUES (5, 1, '权限系统', '', 'perm', 0, 1, 5, 1);
INSERT INTO `backmenu` VALUES (6, 1, '数据库备份', '', 'dbase', 0, 1, 6, 0);
INSERT INTO `backmenu` VALUES (9, 1, '产品管理', '', '/admin/product/product_manage.php', 1, 2, 9, 1);
INSERT INTO `backmenu` VALUES (8, 1, '产品分类', '', '/admin/product/product_dir.php', 1, 2, 8, 1);
INSERT INTO `backmenu` VALUES (47, 1, '区块管理', '', '/admin/siteset/layout.php', 44, 2, 47, 1);
INSERT INTO `backmenu` VALUES (15, 1, '信息分类', '', '/admin/news/news_dir.php', 3, 2, 15, 1);
INSERT INTO `backmenu` VALUES (16, 1, '信息管理', '', '/admin/news/news_manage.php', 3, 2, 16, 1);
INSERT INTO `backmenu` VALUES (17, 1, '员工档案', '', '/admin/hr/hr_staff.php', 4, 2, 17, 1);
INSERT INTO `backmenu` VALUES (18, 1, 'test', '', '/admin/hr/hr_exam.php', 4, 2, 18, 0);
INSERT INTO `backmenu` VALUES (19, 1, 'test2', '', '/admin/hr/hr_job.php', 4, 2, 19, 0);
INSERT INTO `backmenu` VALUES (20, 1, '系统菜单', '', '/admin/perm/perm_menu.php', 5, 2, 20, 1);
INSERT INTO `backmenu` VALUES (21, 1, '权限管理', '', '/admin/perm/perm_manage.php', 5, 2, 21, 1);
INSERT INTO `backmenu` VALUES (22, 1, '数据库备份', '', '/phpMyAdmin/', 6, 2, 22, 1);
INSERT INTO `backmenu` VALUES (48, 1, '版面管理', '', '/admin/siteset/pageset.php', 44, 2, 48, 1);
INSERT INTO `backmenu` VALUES (49, 1, '前台菜单', '', '/admin/siteset/webmenu.php', 44, 2, 49, 0);
INSERT INTO `backmenu` VALUES (39, 1, '信息回收站', '', '/admin/news/newsrecycle.php', 3, 2, 39, 1);
INSERT INTO `backmenu` VALUES (41, 1, '产品回收站', '', '/admin/product/productrecycle.php', 1, 2, 41, 1);
INSERT INTO `backmenu` VALUES (46, 1, '站点设定', '', '/admin/siteset/siteset.php', 44, 2, 46, 1);
INSERT INTO `backmenu` VALUES (44, 1, '站点管理', '', 'siteset', 0, 1, 1, 1);
INSERT INTO `backmenu` VALUES (50, 1, '留言反馈', '', '/admin/news/news_manage.php?&searchselect=4', 3, 2, 50, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `dept`
-- 

CREATE TABLE `dept` (
  `id_dept` int(11) NOT NULL auto_increment,
  `dept` varchar(25) NOT NULL,
  `lang` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id_dept`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- 
-- 导出表中的数据 `dept`
-- 

INSERT INTO `dept` VALUES (36, '111', 1);
INSERT INTO `dept` VALUES (35, 'q', 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `exam`
-- 

CREATE TABLE `exam` (
  `id_exam` int(11) NOT NULL auto_increment,
  `lang` int(1) NOT NULL default '1',
  `name` varchar(25) NOT NULL,
  `level` varchar(1) NOT NULL,
  `examdate` date NOT NULL,
  PRIMARY KEY  (`id_exam`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `exam`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `hr`
-- 

CREATE TABLE `hr` (
  `id_hr` int(11) NOT NULL auto_increment,
  `lang` int(1) NOT NULL default '1',
  `name` varchar(25) NOT NULL,
  `sex` int(1) NOT NULL default '1',
  `birthday` date NOT NULL,
  `hrcode` varchar(10) NOT NULL,
  `dept` int(11) NOT NULL,
  `iswork` int(1) NOT NULL default '1',
  `idcard` varchar(28) NOT NULL,
  `ismarry` int(1) NOT NULL,
  `nation` varchar(30) NOT NULL,
  `native` varchar(30) NOT NULL,
  `register` varchar(60) NOT NULL,
  `inwork` date NOT NULL,
  `education` varchar(20) NOT NULL,
  `profession` varchar(20) NOT NULL,
  `school` varchar(40) NOT NULL,
  `political` varchar(20) NOT NULL,
  `post` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `address` varchar(60) NOT NULL,
  `hometel` varchar(20) NOT NULL,
  `mobi` varchar(20) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `hjqk` text NOT NULL,
  `cfqk` text NOT NULL,
  `gwbd` text NOT NULL,
  `ldht` text NOT NULL,
  `sbjn` text NOT NULL,
  `remark` text NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `dele` int(1) NOT NULL default '1',
  `level` int(1) NOT NULL default '1',
  `indate` datetime NOT NULL,
  `modate` datetime NOT NULL,
  `deldate` datetime NOT NULL,
  `logindate` datetime NOT NULL,
  `loginip` varchar(16) NOT NULL,
  PRIMARY KEY  (`id_hr`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

-- 
-- 导出表中的数据 `hr`
-- 

INSERT INTO `hr` VALUES (1, 1, 'administrator', 1, '0000-00-00', '', 36, 1, '', 0, '', '', '', '2011-01-29', '', '', '', '', 9, 15, '', '', '', '', '', '', '', '', '', '', 'admin', 'admin888', 1, 1, '2011-01-29 18:08:13', '2011-02-25 22:22:35', '0000-00-00 00:00:00', '2012-10-21 19:33:07', '127.0.0.1');

-- --------------------------------------------------------

-- 
-- 表的结构 `layout`
-- 

CREATE TABLE `layout` (
  `id_layout` int(11) NOT NULL auto_increment,
  `lang` int(1) NOT NULL default '1',
  `title` varchar(250) NOT NULL,
  `url` text NOT NULL,
  `intro` text NOT NULL,
  `content` text NOT NULL,
  `openstat` int(1) NOT NULL default '1',
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY  (`id_layout`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- 导出表中的数据 `layout`
-- 

INSERT INTO `layout` VALUES (1, 1, '全局LOGO', '', '', '', 0, 1);
INSERT INTO `layout` VALUES (2, 1, '中文-页脚文字', '', '', '&copy; 2012 SHANGHAI TENGYAN TECH CO,.LTD 上海腾岩信息科技有限公司 版权所有 <a href="http://www.miibeian.gov.cn/" target="_blank">沪ICP备10009206号</a><br />\r\nEmail: info@ty-sh.com biz@ty-sh.com 电话:021-37691017 传真:021-37691567 地址:上海市松江区叶榭双高广场2503室<br />\r\n', 0, 2);
INSERT INTO `layout` VALUES (3, 1, '全局首页BANNER图', '', '', '', 0, 3);
INSERT INTO `layout` VALUES (4, 1, '中文首页-公司简介四小块内容', '', '', '', 0, 4);
INSERT INTO `layout` VALUES (5, 1, '中文首页-推荐三块内容', '', '', '', 0, 5);
INSERT INTO `layout` VALUES (6, 1, '英文首页-公司简介四小块内容', '', '', '', 0, 6);
INSERT INTO `layout` VALUES (7, 1, '英文首页-推荐三块内容', '', '', '', 0, 7);
INSERT INTO `layout` VALUES (8, 1, '英文-页脚文字', '', '', '&copy; 2012 SHANGHAI TENGYAN TECH CO,.LTD 上海腾岩信息科技有限公司11111 版权所有 <a href="http://www.miibeian.gov.cn/" target="_blank">沪ICP备10009206号</a><br />\r\nEmail: info@ty-sh.com biz@ty-sh.com 电话:021-37691017 传真:021-37691567 地址:上海市松江区叶榭双高广场2503室<br />\r\n', 0, 8);

-- --------------------------------------------------------

-- 
-- 表的结构 `layoutpic`
-- 

CREATE TABLE `layoutpic` (
  `id_layoutpic` int(11) NOT NULL auto_increment,
  `id_layout` int(11) NOT NULL,
  `id_hr` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `intro` text NOT NULL,
  `url` varchar(250) NOT NULL,
  `opicname` varchar(250) NOT NULL,
  `spicname` varchar(250) NOT NULL,
  `dele` int(1) NOT NULL default '1',
  `type` varchar(3) NOT NULL,
  `indate` datetime NOT NULL,
  `modate` datetime NOT NULL,
  `deldate` datetime NOT NULL,
  `browsecount` int(11) NOT NULL,
  PRIMARY KEY  (`id_layoutpic`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

-- 
-- 导出表中的数据 `layoutpic`
-- 

INSERT INTO `layoutpic` VALUES (7, 3, 1, '', '', '', '1349592026.jpg', '', 1, 'JPG', '2012-10-07 14:40:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (5, 1, 1, 'LOGO', '', '', '1349510071.png', '', 1, 'PNG', '2012-10-06 15:54:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (8, 3, 1, '', '', '', '1349592039.jpg', '', 1, 'JPG', '2012-10-07 14:40:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (9, 3, 1, '', '', '', '1349592048.jpg', '', 1, 'JPG', '2012-10-07 14:40:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (10, 3, 1, '', '', '', '1349592057.jpg', '', 1, 'JPG', '2012-10-07 14:40:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (11, 4, 1, '公司简介', '公司拥有领先的技术和经验，目前是引领该行业的先锋企业。111', '/about/about.php', '1349593344.jpg', '', 1, 'JPG', '2012-10-07 15:02:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (12, 4, 1, '新品介绍', '通过WAP虚拟主机建立网站后，在国内任何一部手机上都可浏览到网站信息。', '#', '1349593417.jpg', '', 1, 'JPG', '2012-10-07 15:03:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (13, 4, 1, '解决方案', '使用户在享受信息科技发展最新成果的同时不断获得最大的收益。', '#', '1349593487.jpg', '', 1, 'JPG', '2012-10-07 15:04:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (14, 4, 1, '新闻动态', '与江苏温阳律师事务所签约，建立长期合作伙伴关系。333', '#', '1349593515.jpg', '', 1, 'JPG', '2012-10-07 15:05:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (15, 5, 1, '最新办公电脑', '期待与腾岩一起创造未来的人才。', '#', '1349678678.jpg', '', 1, 'JPG', '2012-10-07 15:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (16, 5, 1, '公司会议系统', '期待与腾岩一起创造未来的人才。', '#', '1349678691.jpg', '', 1, 'JPG', '2012-10-07 15:26:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (17, 5, 1, '产品系列', '期待与腾岩一起创造未来的人才。', '#', '1349678703.jpg', '', 1, 'JPG', '2012-10-07 15:27:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (33, 6, 1, 'Company introduction', 'Tengyan is a market leader. It’s been awarded a CMS of the year 2007, 2008 and won a Hall ', '', 'nopic.gif', '', 1, 'GIF', '2012-10-20 19:18:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (34, 6, 1, 'Market leader', 'market leader. It’s been awarded a CMS of the year 2007, 2008 and won a......', '', 'nopic.gif', '', 1, 'GIF', '2012-10-20 19:18:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (35, 6, 1, 'Site planning, design', 'Site planning, design, construction, the accumulation seven professional establishment of the station......', '', 'nopic.gif', '', 1, 'GIF', '2012-10-20 19:18:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (36, 6, 1, 'Let us lead the industry', 'let us lead the industry, Teng rock technicians adhere innovation and a large number ', '', 'nopic.gif', '', 1, 'GIF', '2012-10-20 19:18:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (37, 7, 1, 'innovation and a large', 'innovation and a large number', '', '1350732396.jpg', '', 1, 'JPG', '2012-10-20 19:26:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (38, 7, 1, 'Site planning, design', 'Site planning, design, construction, ', '', '1350732410.jpg', '', 1, 'JPG', '2012-10-20 19:26:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `layoutpic` VALUES (39, 7, 1, 'Tengyan is a market leader', 'Tengyan is a market leader. It’s been', '', '1350732419.jpg', '', 1, 'JPG', '2012-10-20 19:26:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `newsdir`
-- 

CREATE TABLE `newsdir` (
  `id_newsdir` int(11) NOT NULL auto_increment,
  `lang` int(1) NOT NULL default '1',
  `name` varchar(25) NOT NULL,
  `intro` text NOT NULL,
  `dele` int(1) NOT NULL default '1',
  `fatherid` int(11) NOT NULL,
  `level` int(1) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY  (`id_newsdir`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- 
-- 导出表中的数据 `newsdir`
-- 

INSERT INTO `newsdir` VALUES (1, 1, '信息中心', '', 1, 0, 1, 1);
INSERT INTO `newsdir` VALUES (2, 1, '公司新闻', '', 1, 1, 2, 2);
INSERT INTO `newsdir` VALUES (3, 1, '留言反馈', '', 1, 0, 1, 3);
INSERT INTO `newsdir` VALUES (4, 1, '留言反馈', '', 1, 3, 2, 4);
INSERT INTO `newsdir` VALUES (5, 1, '行业新闻', '', 1, 1, 2, 5);
INSERT INTO `newsdir` VALUES (7, 1, '产品新闻', '', 1, 1, 2, 7);
INSERT INTO `newsdir` VALUES (8, 0, 'News Center', '', 1, 0, 1, 8);
INSERT INTO `newsdir` VALUES (9, 0, 'Company News', '', 1, 8, 2, 9);
INSERT INTO `newsdir` VALUES (13, 1, '电子行业', '', 1, 12, 2, 13);
INSERT INTO `newsdir` VALUES (10, 0, 'Industry News', '', 1, 8, 2, 10);
INSERT INTO `newsdir` VALUES (11, 0, 'Product News', '', 1, 8, 2, 11);
INSERT INTO `newsdir` VALUES (12, 1, '案例展示', '', 1, 0, 1, 12);
INSERT INTO `newsdir` VALUES (14, 1, '机械行业', '', 1, 12, 2, 14);
INSERT INTO `newsdir` VALUES (15, 1, '新品介绍', '', 1, 1, 2, 15);
INSERT INTO `newsdir` VALUES (16, 1, '信息科技行业', '', 1, 12, 2, 16);
INSERT INTO `newsdir` VALUES (17, 1, '医药行业', '', 1, 12, 2, 17);
INSERT INTO `newsdir` VALUES (18, 0, 'Case', '', 1, 0, 1, 18);
INSERT INTO `newsdir` VALUES (19, 0, 'Case item1', '', 1, 18, 2, 19);
INSERT INTO `newsdir` VALUES (20, 0, 'Case item2', '', 1, 18, 2, 20);
INSERT INTO `newsdir` VALUES (21, 0, 'Case item3', '', 1, 18, 2, 21);
INSERT INTO `newsdir` VALUES (22, 0, 'Case item4', '', 1, 18, 2, 22);

-- --------------------------------------------------------

-- 
-- 表的结构 `newsinfo`
-- 

CREATE TABLE `newsinfo` (
  `id_newsinfo` int(11) NOT NULL auto_increment,
  `id_newsdir` int(11) NOT NULL,
  `id_hr` int(11) NOT NULL,
  `lang` int(1) NOT NULL default '1',
  `title` varchar(250) NOT NULL,
  `intro` text NOT NULL,
  `content` longtext NOT NULL,
  `tag` text NOT NULL,
  `dele` int(1) NOT NULL default '1',
  `isnew` int(1) NOT NULL default '1',
  `url` varchar(255) NOT NULL,
  `newsdate` date NOT NULL,
  `indate` datetime NOT NULL,
  `modate` datetime NOT NULL,
  `deldate` datetime NOT NULL,
  `browsecount` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY  (`id_newsinfo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- 导出表中的数据 `newsinfo`
-- 

INSERT INTO `newsinfo` VALUES (2, 2, 0, 1, '上海腾岩信息科技有限公司成立七周年', '七年专业建站技术的积累，让我们引领行业，一直以来，腾岩的技术人员坚持自主创新和自主研发的理念，创新了众多的建设技术,我们会不断的努力......', '<table border="0" cellpadding="0" cellspacing="10" style="width: 100%; ">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width:50%">\r\n				<h3>\r\n					Title 1</h3>\r\n			</td>\r\n			<td>\r\n				&nbsp;</td>\r\n			<td style="width:50%">\r\n				<h3>\r\n					Title 2</h3>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<div>\r\n					公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</div>\r\n				<div>\r\n					&nbsp;</div>\r\n				<div>\r\n					腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。</div>\r\n				<div>\r\n					&nbsp;</div>\r\n				<div>\r\n					我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</div>\r\n				<div>\r\n					&nbsp;</div>\r\n				<div>\r\n					腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。</div>\r\n			</td>\r\n			<td>\r\n				&nbsp;</td>\r\n			<td>\r\n				<div>\r\n					腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。</div>\r\n				<div>\r\n					&nbsp;</div>\r\n				<div>\r\n					我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</div>\r\n				<div>\r\n					&nbsp;</div>\r\n				<div>\r\n					腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。<br />\r\n					<br />\r\n					公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	<br />\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</p>\r\n', '', 1, 1, '', '2012-10-12', '2012-10-12 17:31:19', '2012-10-16 12:00:02', '0000-00-00 00:00:00', 0, 14);
INSERT INTO `newsinfo` VALUES (3, 2, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 21:49:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 2);
INSERT INTO `newsinfo` VALUES (4, 7, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 21:49:20', '2012-10-15 22:00:15', '0000-00-00 00:00:00', 0, 3);
INSERT INTO `newsinfo` VALUES (5, 15, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 21:49:21', '2012-10-15 22:00:50', '0000-00-00 00:00:00', 0, 4);
INSERT INTO `newsinfo` VALUES (6, 5, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 21:49:21', '2012-10-15 22:00:40', '0000-00-00 00:00:00', 0, 5);
INSERT INTO `newsinfo` VALUES (7, 5, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 21:49:22', '2012-10-15 22:00:26', '0000-00-00 00:00:00', 0, 6);
INSERT INTO `newsinfo` VALUES (8, 2, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 21:49:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 7);
INSERT INTO `newsinfo` VALUES (9, 2, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 22:02:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 8);
INSERT INTO `newsinfo` VALUES (10, 2, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 22:02:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 9);
INSERT INTO `newsinfo` VALUES (11, 2, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 22:02:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 10);
INSERT INTO `newsinfo` VALUES (12, 2, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 22:02:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 11);
INSERT INTO `newsinfo` VALUES (13, 2, 0, 1, '新增空白信息', '', '', '', 1, 1, '', '2012-10-15', '2012-10-15 22:02:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 12);
INSERT INTO `newsinfo` VALUES (14, 5, 0, 1, '我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持', '腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。', '<p>\r\n	<img alt="" src="/upload/other/images/20121016_040154.jpg" style="width: 313px; height: 211px; float: right; border-width: 1px; border-style: solid; " />腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。 &nbsp;</p>\r\n<div>\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。</div>\r\n<br />\r\n', '', 1, 1, '', '2012-10-15', '2012-10-15 22:02:49', '2012-10-21 20:17:07', '0000-00-00 00:00:00', 0, 13);
INSERT INTO `newsinfo` VALUES (15, 2, 0, 1, '网站策划、设计、建设', '腾岩科技为您量身定做各类网站，会根据您的需求和您公司的特色，为您订制特色网站。', '<h3>\r\n	&nbsp;</h3>\r\n<p>\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。</p>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</div>\r\n<br />\r\n<img alt="" src="/upload/other/images/20121017_140340.jpg" style="width: 680px; height: 278px; " /><br />\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。&nbsp;</div>\r\n<br />\r\n', '', 1, 1, '', '2012-10-15', '2012-10-15 22:02:49', '2012-10-17 22:03:50', '0000-00-00 00:00:00', 0, 15);
INSERT INTO `newsinfo` VALUES (16, 13, 0, 1, '中英文双语版', '运用最新UI设计元素及表现手法，本公司设计师为您打造独特的网站，让您的网站在行业中脱颖而出。\r\n该版本正在设计中，尽请期待......', '<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。<br />\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</div>\r\n<br />\r\n<img alt="" src="/upload/other/images/20121017_130451.jpg" style="width: 680px; height: 278px; " /><br style="font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; " />\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。&nbsp;</div>\r\n', '', 1, 1, '', '2012-10-17', '2012-10-17 20:59:59', '2012-10-17 21:05:08', '0000-00-00 00:00:00', 0, 16);
INSERT INTO `newsinfo` VALUES (17, 9, 0, 1, '公司拥有领先的技术和经验,目前是引领该行业的......', '公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。', '<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。<br />\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</div>\r\n<br />\r\n<img alt="" src="/upload/other/images/20121017_130451.jpg" style="width: 680px; height: 278px; " /><br style="font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; " />\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。&nbsp;</div>\r\n', '', 1, 1, '', '2012-10-21', '2012-10-21 19:39:20', '2012-10-21 19:41:32', '0000-00-00 00:00:00', 0, 17);
INSERT INTO `newsinfo` VALUES (18, 19, 0, 1, '目前是引领该行业的先锋企业', '公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。', '<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。<br />\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</div>\r\n<br style="font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; " />\r\n<img alt="" src="http://demo-l1.com/upload/other/images/20121017_130451.jpg" style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; width: 680px; height: 278px; " /><br style="font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; " />\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。&nbsp;</div>\r\n', '', 1, 1, '', '2012-10-21', '2012-10-21 20:18:23', '2012-10-21 20:20:19', '0000-00-00 00:00:00', 0, 18);

-- --------------------------------------------------------

-- 
-- 表的结构 `newspic`
-- 

CREATE TABLE `newspic` (
  `id_newspic` int(11) NOT NULL auto_increment,
  `id_newsinfo` int(11) NOT NULL,
  `id_hr` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `intro` text NOT NULL,
  `url` varchar(250) NOT NULL,
  `opicname` varchar(250) NOT NULL,
  `spicname` varchar(250) NOT NULL,
  `dele` int(1) NOT NULL default '1',
  `type` varchar(3) NOT NULL,
  `indate` datetime NOT NULL,
  `modate` datetime NOT NULL,
  `deldate` datetime NOT NULL,
  `browsecount` int(11) NOT NULL,
  PRIMARY KEY  (`id_newspic`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- 
-- 导出表中的数据 `newspic`
-- 

INSERT INTO `newspic` VALUES (18, 2, 1, '', '', '', '1350308140.jpg', '', 1, 'JPG', '2012-10-15 21:35:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `newspic` VALUES (19, 15, 1, '', '', '', '1350355626.jpg', '', 1, 'JPG', '2012-10-16 10:47:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `newspic` VALUES (20, 14, 1, '', '', '', '1350360154.jpg', '', 1, 'JPG', '2012-10-16 12:02:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `newspic` VALUES (21, 16, 1, '', '', '', '1350478933.jpg', '', 1, 'JPG', '2012-10-17 21:02:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `newspic` VALUES (22, 17, 1, '', '', '', '1350819660.jpg', '', 1, 'JPG', '2012-10-21 19:41:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `newspic` VALUES (23, 18, 1, '', '', '', '1350821932.jpg', '', 1, 'JPG', '2012-10-21 20:18:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `pageset`
-- 

CREATE TABLE `pageset` (
  `id_pageset` int(11) NOT NULL auto_increment,
  `lang` int(1) NOT NULL default '1',
  `title` varchar(250) NOT NULL,
  `url` text NOT NULL,
  `pagetitle` text NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY  (`id_pageset`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- 导出表中的数据 `pageset`
-- 

INSERT INTO `pageset` VALUES (1, 1, '公司简介', '', '111111', '222222222', '3333333333', '<p>\r\n	<img class="right" src="/upload/other/images/20121013_093524.jpg" style="width: 220px; height: 260px; " /><br />\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。<br />\r\n	<br />\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。<br />\r\n	<br />\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。<br />\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。<br />\r\n	<br />\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。<br />\r\n	<br />\r\n	腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。</p>\r\n<br />\r\n<br />\r\n');
INSERT INTO `pageset` VALUES (2, 1, '发展历程', '', '', '', '', '<p>\r\n	<br />\r\n	<br />\r\n	2005年2月 成立团队<br />\r\n	2006年3月 成为商务中国最高级别代理-伙伴代理<br />\r\n	2006年8月 成为新网互联最高级别代理-合作伙伴<br />\r\n	2007年4月 与网宿科技股份有限公司展开合作<br />\r\n	2008年7月 与深圳市润迅移动通信服务有限公司展开合作<br />\r\n	2009年12月 上海腾岩科技信息有限公司成立<br />\r\n	2010年9月 经过多年调试和完善，正式推出网站后台管理系统<br />\r\n	2011年10月 成功代理网易 (NASDAQ: NTES)专业企业邮局<br />\r\n	2011年11月 与慧新信息科技有限公司展开合作<br />\r\n	2011年12月 成为香港联亚国际电讯有限公司最高级别代理-合作伙伴</p>\r\n');
INSERT INTO `pageset` VALUES (3, 1, '解决方案', '', '', '', '', '<p>江苏温阳律师事务所</br>\r\n地址：南京市广州路37号江苏科技大厦27层</br></br>\r\n\r\n江苏温阳律师事务所是经江苏省司法厅批准成立的综合性律师事务所，致力于为委托人及顾问单位提供优质高效的法律服务。自成立以来发展迅速，现已成为南京市温州商会副会长单位。以主任翁小平律师为核心律师团队中，所有专职律师均具有硕士、本科以上学历，主任翁小平律师荣获 “2008年-2011年南京市司法行政系统优秀青年律师”。</br></br>\r\n\r\n本所以公司经营法律业务为专长，主要涉及：公司法人治理结构的设计，公司合并、分立、收购、重组，公司股权的转让、赠与、继承和抵押，公司清盘、清算、破产以及债务的执行，对各种不同的商业安排提供构架、参与商业谈判并制作文件，草拟、修订、审查民商事合同，处理合同纠纷，对有关税务计划、劳动关系、知识产权以及法律适用等问题的咨询服务。在建设工程房地产法律事务方面：协调处理各类建设工程施工纠纷；帮助房地产开发企业处理有关房地产项目开发建设销售中的各类法律问题以及与不动产所有权、担保物权、土地使用权纠纷相关问题的处理。除此之外主要提供刑事、婚姻、继承、交通事故、医疗、保险等民事纠纷等法律服务。</br></br>\r\n\r\n本所取名“温阳”二字有多重寓意，其一，主任翁小平律师祖籍为温州平阳；其二，本所提供体现公平、维护正义、为当事人争取合法权益的法律服务，希望能象阳光一样温暖社会，捍卫公平和正义；其三，本所所标中间红色为太阳，周围绿色象征大地、生命，黄色表示阳光普照，此即“天时、地利、人和”。 寓意一切为委托人把好最佳时机和最佳方案，一切为委托人的合法权益出发，达到最大圆满结果；其四，闽南语“稳赢”的发音即为普通话“温阳”的发音，旨在有充分的信心完成所有委托事项。</br></br>\r\n\r\n本所希望为委托人的重大决策把好法律关，避免风险及纠纷。本所服务宗旨为：优质高效、品牌专业、诚实守信、尽心尽责。温阳律师事务所，温州人自己的专业法律顾问！</br>\r\n</p>');
INSERT INTO `pageset` VALUES (4, 1, '企业文化', '', '', '', '', '<p>\r\n腾岩企业文化<br><br>\r\n自信、自律，自立、自强客户：为客户提供高质量和最大价值的专业化产品和服务，以真诚和实力赢得客户的理解、尊重和支持。<br><br>\r\n\r\n员工：信任员工的努力和奉献，承认员工的成就并提供相应回报，为员工创造良好的工作环境和发展前景。<br><br>\r\n\r\n市场：为客户降低采购成本和风险，为客户投资提供切实保障。<br><br> \r\n\r\n发展：追求永续发展的目标，并把它建立在客户满意的基础上。<br><br>\r\n\r\n企业精神：自信、自律，自立、自强客户：为客户提供高质量和最大价值的专业化产品和服务，以真诚和实力赢得客户的理解、尊重和支持。<br><br>\r\n</p>');
INSERT INTO `pageset` VALUES (5, 1, '合作伙伴', '', '', '', '', '<p>联亚国际电讯有限公司联亚国际电讯有限公司（ACT INTERNATIONAL TELECOM LIMITED，以下简称：联亚国际）是一家著名的香港电讯企业。 \r\n2006年以来，为海内外客户提供包括语音增值业务、数据专线及互联网服务等各种电信增值业务，客户遍及欧洲、北美、台湾及东南亚等地。\r\n经过多年的成功运营，联亚国际不仅积累了丰富的网络层交换及互联网维护经验，还汇聚了多位国内顶尖的linux/freeBSD/unix经验的系统工程师、微软认证工程师和网络安全技术人才，也包括一批拥有丰富行业经验和较高威望的专业人士。 </p><p>\r\n\r\n慧新信息科技有限公司慧新信息科技有限公司成立于2011年，是一家新兴的集软件研发与销售为一体的高科技企业，专注于互联网开发客户和电子商务领域。我们拥有高效专业的研发团队和客服团队，可以快速的解决客户的问题，并为客户提供专业和精准 的售后服务。\r\n\r\n公司致力于领先客户开发领域，并持续贯彻“一流效用、相互信赖、优质服务、研发创新”的品质政策，与国内数千家外贸公司合作，积极更新高效率客户开发方法并惯切与软件中，使公司的产品在国内市场上更具竞争力。 “诚信合作，共创双赢”是我们的最终目标。 </p><p>\r\n\r\n北京新网互联科技有限公司历经8年坚实发展，北京新网互联科技有限公司致力于为企业提供一流的综合性网络营销服务，不断推出的基于互联网技术的创新应用产品，力求在为客户和合作伙伴创造价值的过程中实现自身价值。 </p><p>\r\n\r\n新网互联在北京、上海、广州、深圳、南京、杭州、成都、厦门以及青岛、沈阳、西安、武汉、郑州、重庆等全国主要城市均设有分支机构，此外新网互联在全国有累计超过万家合作伙伴，间接或直接提供的服务已经遍及全国。 </p><p>\r\n\r\n商务中国商务中国创立于2001年。通过业界独创的虚拟渠道管理体系VCP（Virtual Channel Provider），自创立于以来，始终坚持“渠道为王”的销售模式，通过不断的拓新产品，优化服务，与众多合作伙伴一起携手创造了逾十年辉煌的历史。\r\n\r\n商务中国做为逾十年丰富经验的中国领先价值平台服务提供商，立足于通过提供综合的互联网服务，为客户搭建以企业综合效率提升为目的的价值平台。在新的征程中，商务中国高端云计算技术，将致力于更高效、更全面地为用户提供基于互联网、移动网络等的智能化应用服务。 </p><p>\r\n\r\n网易 (NASDAQ: NTES)网易 (NASDAQ: NTES)是中国领先的互联网技术公司，邮件业务是网易公司的发展重点及重要基础服务。1997年11月，网易自主研发了国内首个全中文的免费电子邮件系统。时至今天，网易旗下电子邮箱用户总数已突破4亿，免费邮箱和收费邮箱市场占有率均稳居全国第一。\r\n网易企业邮箱，采用业内顶尖技术，由具有丰富经验的专业团队开发运营，致力于为企业用户提供中国最专业的电子邮箱服务。\r\n </p><p>\r\n网宿科技股份有限公司网宿科技股份有限公司，最早成立于2000年1月，是国内领先的互联网业务平台服务提供商，主要向客户提供内容分发与加速、服务器托管、服务器租用等互联网业务平台解决方案，是国内最早开展IDC和CDN业务的厂商之一。2009年10月，网宿科技在深交所上市。\r\n\r\n网宿科技在全国拥有北京、上海、广州、深圳等4个营销分公司以及位于厦门的研发中心，员工总数超过500人。目前公司服务的客户近2000家，是市场同类公司中拥有客户数量最多、行业覆盖面最广的公司之一。 </p><p>\r\n\r\n深圳市润迅移动通信服务有限公司深圳市润迅移动通信服务有限公司，是润迅集团下属专门从事数据业务的事业部制单位，拥有"IDC+ISP+ICP+SP"等十几项国际、国内运营资质，同时具有雄厚的技术实力及丰富的网络资源，专门从事互联网数据通信业务。\r\n润迅集团在世界各地都建有资源丰富的电信级枢纽机房。国内对外运营的机房有深圳、广州、上海、惠州、香港等几个大型数据中心，并与国内各大电信运营商互联互通，并且发展了多家国际客户，在业界享有盛名，引航行业市场。 </p>');
INSERT INTO `pageset` VALUES (6, 1, '联系我们', '', '', '', '', '<p>\r\n<br>上海腾岩信息科技有限公司</br>\r\n<br>Email: info@ty-sh.com biz@ty-sh.com</br>\r\n<br>地址:上海市松江区叶榭双高商务广场2503室 </br>\r\n<br>电话:021-37691017 传真:021-37691567</br>\r\n</p>');
INSERT INTO `pageset` VALUES (7, 1, '人才招聘', '', '', '', '', '<p>\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</p>\r\n<img class="alignleft" src="http://cs1.com/inc/pics/content/pic13.jpg" />\r\n<p>\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。</p>\r\n<p>\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</p>\r\n');
INSERT INTO `pageset` VALUES (8, 1, 'About us', '', '', '', '', '<p>\r\n	<img class="right" src="/upload/other/images/20121013_093524.jpg" style="width: 220px; height: 260px; " /><br />\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。<br />\r\n	<br />\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。<br />\r\n	<br />\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。<br />\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。<br />\r\n	<br />\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。<br />\r\n	<br />\r\n	腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。</p>\r\n<br />\r\n<br />\r\n');
INSERT INTO `pageset` VALUES (9, 1, 'History', '', '', '', '', '\r\n<p>\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。<br />\r\n	&nbsp;</p>\r\n<p>\r\n	<img alt="" class="left" src="/upload/other/images/20121020_121308.jpg" style="width: 750px; height: 221px; " /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	我们的业务范围</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。<br />\r\n	<br />\r\n	&nbsp;</p>\r\n');
INSERT INTO `pageset` VALUES (10, 1, 'Solution', '', '', '', '', '<p>\r\n	Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	&nbsp;</p>\r\n');
INSERT INTO `pageset` VALUES (12, 1, 'Partner', '', '', '', '', '<p>\r\n	Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	&nbsp;</p>\r\n');
INSERT INTO `pageset` VALUES (11, 1, 'Culture', '', '', '', '', '<p>\r\n	Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	Tengyan has a massive developers community (more than 2000 members). This ensures a huge range of free, professional and high quality resources.</p>\r\n<p>\r\n	Tengyan has no costly licensing fees or risk of vendor lock-in. It can significantly reduce total project integration costs.Thanks to a huge library of free extensions Tengyan has become the most powerful, robust and extensible Content Management System available today.</p>\r\n<p>\r\n	&nbsp;</p>\r\n');
INSERT INTO `pageset` VALUES (13, 1, 'HR', '', '', '', '', '<p>\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</p>\r\n<img class="alignleft" src="http://cs1.com/inc/pics/content/pic13.jpg" />\r\n<p>\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。</p>\r\n<p>\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</p>\r\n');
INSERT INTO `pageset` VALUES (14, 1, 'Contact us', '', '', '', '', '<p>\r\n	<br />\r\n	上海腾岩信息科技有限公司<br />\r\n	<br />\r\n	Email: info@ty-sh.com biz@ty-sh.com<br />\r\n	<br />\r\n	地址:上海市松江区叶榭双高商务广场2503室<br />\r\n	<br />\r\n	电话:021-37691017 传真:021-37691567</p>');

-- --------------------------------------------------------

-- 
-- 表的结构 `pagesetpic`
-- 

CREATE TABLE `pagesetpic` (
  `id_pagesetpic` int(11) NOT NULL auto_increment,
  `id_pageset` int(11) NOT NULL,
  `id_hr` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `intro` text NOT NULL,
  `url` varchar(250) NOT NULL,
  `opicname` varchar(250) NOT NULL,
  `spicname` varchar(250) NOT NULL,
  `dele` int(1) NOT NULL default '1',
  `type` varchar(3) NOT NULL,
  `indate` datetime NOT NULL,
  `modate` datetime NOT NULL,
  `deldate` datetime NOT NULL,
  `browsecount` int(11) NOT NULL,
  PRIMARY KEY  (`id_pagesetpic`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

-- 
-- 导出表中的数据 `pagesetpic`
-- 

INSERT INTO `pagesetpic` VALUES (20, 1, 1, 'BANNER', '', '', '1350120903.jpg', '', 1, 'JPG', '2012-10-13 17:35:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (21, 2, 1, '', '', '', '1350123468.jpg', '', 1, 'JPG', '2012-10-13 18:17:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (22, 3, 1, '', '', '', '1350123497.jpg', '', 1, 'JPG', '2012-10-13 18:18:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (23, 4, 1, '', '', '', '1350123529.jpg', '', 1, 'JPG', '2012-10-13 18:18:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (24, 5, 1, '', '', '', '1350123560.jpg', '', 1, 'JPG', '2012-10-13 18:19:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (25, 7, 1, '', '', '', '1350483541.jpg', '', 1, 'JPG', '2012-10-17 22:19:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (26, 8, 1, '', '', '', '1350734560.jpg', '', 1, 'JPG', '2012-10-20 20:02:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (27, 9, 1, '', '', '', '1350735514.jpg', '', 1, 'JPG', '2012-10-20 20:18:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (28, 10, 1, '', '', '', '1350736543.jpg', '', 1, 'JPG', '2012-10-20 20:35:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (29, 11, 1, '', '', '', '1350736911.jpg', '', 1, 'JPG', '2012-10-20 20:41:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (30, 12, 1, '', '', '', '1350736935.jpg', '', 1, 'JPG', '2012-10-20 20:42:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `pagesetpic` VALUES (31, 13, 1, '', '', '', '1350822368.jpg', '', 1, 'JPG', '2012-10-21 20:26:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `pavy1`
-- 

CREATE TABLE `pavy1` (
  `id_pavy1` int(11) NOT NULL auto_increment,
  `id_hr` int(11) NOT NULL,
  `lang` int(1) NOT NULL default '1',
  `product_visit` int(1) NOT NULL default '0',
  `store_visit` int(1) NOT NULL default '0',
  `news_visit` int(1) NOT NULL default '0',
  `hr_visit` int(1) NOT NULL default '0',
  `pavy_visit` int(1) NOT NULL default '0',
  `data_visit` int(1) NOT NULL default '0',
  `siteset_visit` int(1) NOT NULL default '0',
  `level` int(1) NOT NULL default '0',
  `indate` datetime NOT NULL,
  `modate` datetime NOT NULL,
  `deldate` datetime NOT NULL,
  PRIMARY KEY  (`id_pavy1`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- 
-- 导出表中的数据 `pavy1`
-- 

INSERT INTO `pavy1` VALUES (28, 1, 1, 1, 0, 1, 1, 1, 0, 1, 0, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- 表的结构 `pavy2`
-- 

CREATE TABLE `pavy2` (
  `id_pvay2` int(11) NOT NULL auto_increment,
  `id_hr` int(11) NOT NULL,
  `id_backmenu` int(11) NOT NULL,
  `lang` int(1) NOT NULL default '1',
  `browseprem` int(1) NOT NULL default '0',
  `addprem` int(1) NOT NULL default '0',
  `editprem` int(1) NOT NULL default '0',
  `deleprem` int(1) NOT NULL default '0',
  `display` int(1) NOT NULL default '1',
  `level` int(1) NOT NULL default '0',
  `state` int(1) NOT NULL default '1',
  `indate` datetime NOT NULL,
  `modate` datetime NOT NULL,
  `deldate` datetime NOT NULL,
  PRIMARY KEY  (`id_pvay2`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=265 ;

-- 
-- 导出表中的数据 `pavy2`
-- 

INSERT INTO `pavy2` VALUES (246, 1, 46, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (245, 1, 41, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (244, 1, 39, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (243, 1, 22, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (242, 1, 21, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (241, 1, 20, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (240, 1, 19, 1, 0, 0, 0, 0, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (239, 1, 18, 1, 0, 0, 0, 0, 0, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (238, 1, 17, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (237, 1, 16, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (236, 1, 15, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (235, 1, 47, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (234, 1, 8, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (233, 1, 9, 1, 1, 1, 1, 1, 1, 0, 1, '2011-01-29 18:08:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (263, 1, 49, 1, 0, 0, 0, 0, 0, 0, 1, '2012-02-26 20:27:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (247, 1, 48, 1, 1, 1, 1, 1, 1, 0, 1, '2011-03-09 16:42:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `pavy2` VALUES (264, 1, 50, 1, 1, 1, 1, 1, 1, 0, 1, '2012-06-15 10:47:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- 表的结构 `post`
-- 

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL auto_increment,
  `post` varchar(25) NOT NULL,
  `lang` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id_post`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- 导出表中的数据 `post`
-- 

INSERT INTO `post` VALUES (1, '普通员工', 1);
INSERT INTO `post` VALUES (2, '物料收发员', 1);
INSERT INTO `post` VALUES (3, 'IQC', 1);
INSERT INTO `post` VALUES (4, '仓库主管', 1);
INSERT INTO `post` VALUES (5, '采购主管', 1);
INSERT INTO `post` VALUES (6, '销售主管', 1);
INSERT INTO `post` VALUES (7, '副总经理', 1);
INSERT INTO `post` VALUES (8, '总经理', 1);
INSERT INTO `post` VALUES (9, '网站管理员', 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `productdir`
-- 

CREATE TABLE `productdir` (
  `id_proddir` int(11) NOT NULL auto_increment,
  `lang` int(1) NOT NULL,
  `name` varchar(50) NOT NULL default '1',
  `intro` text NOT NULL,
  `dele` int(1) NOT NULL default '1',
  `dirurl` varchar(50) NOT NULL,
  `fatherid` int(11) NOT NULL,
  `level` int(1) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY  (`id_proddir`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- 
-- 导出表中的数据 `productdir`
-- 

INSERT INTO `productdir` VALUES (1, 1, '产品中心', '', 1, '', 0, 1, 1);
INSERT INTO `productdir` VALUES (2, 1, '机械设备系统', '', 1, '', 1, 2, 2);
INSERT INTO `productdir` VALUES (3, 1, '电子设备系统', '', 1, '', 1, 2, 3);
INSERT INTO `productdir` VALUES (4, 1, '自动化系列', '', 1, '', 1, 2, 4);
INSERT INTO `productdir` VALUES (5, 1, '电子成型系列', '', 1, '', 1, 2, 5);
INSERT INTO `productdir` VALUES (6, 1, '信息系统设备', '', 1, '', 1, 2, 6);
INSERT INTO `productdir` VALUES (7, 0, 'Product Center', '', 1, '', 0, 1, 7);
INSERT INTO `productdir` VALUES (8, 0, 'Product Item1', '', 1, '', 7, 2, 8);
INSERT INTO `productdir` VALUES (9, 0, 'Product Item2', '', 1, '', 7, 2, 9);
INSERT INTO `productdir` VALUES (10, 0, 'Product Item3', '', 1, '', 7, 2, 10);
INSERT INTO `productdir` VALUES (11, 0, 'Product Item4', '', 1, '', 7, 2, 11);
INSERT INTO `productdir` VALUES (12, 0, 'Product Item5', '', 1, '', 7, 2, 12);

-- --------------------------------------------------------

-- 
-- 表的结构 `productinfo`
-- 

CREATE TABLE `productinfo` (
  `id_prodinfo` int(11) NOT NULL auto_increment,
  `id_proddir` int(11) NOT NULL,
  `id_hr` int(11) NOT NULL,
  `lang` int(1) NOT NULL default '1',
  `title` varchar(250) NOT NULL,
  `intro` text NOT NULL,
  `content` longtext NOT NULL,
  `tag` text NOT NULL,
  `dele` int(1) NOT NULL default '1',
  `isnew` int(1) NOT NULL default '1',
  `indate` datetime NOT NULL,
  `modate` datetime NOT NULL,
  `deldate` datetime NOT NULL,
  `browsecount` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY  (`id_prodinfo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- 导出表中的数据 `productinfo`
-- 

INSERT INTO `productinfo` VALUES (2, 2, 0, 1, '新增空白产品', '', '', '', 1, 1, '2012-10-12 19:37:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 2);
INSERT INTO `productinfo` VALUES (3, 2, 0, 1, '新增空白产品', '', '', '', 1, 1, '2012-10-16 20:39:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 3);
INSERT INTO `productinfo` VALUES (4, 2, 0, 1, '新增空白产品', '', '', '', 1, 1, '2012-10-16 20:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 4);
INSERT INTO `productinfo` VALUES (5, 2, 0, 1, '新增空白产品', '', '', '', 1, 1, '2012-10-16 20:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 5);
INSERT INTO `productinfo` VALUES (6, 2, 0, 1, '新增空白产品', '', '', '', 1, 1, '2012-10-16 20:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 6);
INSERT INTO `productinfo` VALUES (7, 2, 0, 1, '新增空白产品', '', '', '', 1, 1, '2012-10-16 20:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 7);
INSERT INTO `productinfo` VALUES (8, 2, 0, 1, '新增空白产品', '', '', '', 1, 1, '2012-10-16 20:39:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 8);
INSERT INTO `productinfo` VALUES (9, 2, 0, 1, '中文产品测试', '', 'Set up user roles and permissions. Assign Manager, Employee or Admin role with ease. Decide what content is available to whom.Support for multiple-language websites. Enjoy clean, user and search engine friendly URLs. Other SEO friendly features are inside too: Titles, Internal Link Structure, Meta Tags.There are absolutely no restriction on how your site looks like. Create very unique, custom theme.<br />\r\n<br />\r\n<img alt="" src="/upload/other/images/20121016_143900.jpg" style="width: 600px; height: 451px; " /><br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n', '', 1, 1, '2012-10-16 20:39:37', '2012-10-16 22:48:22', '0000-00-00 00:00:00', 0, 9);
INSERT INTO `productinfo` VALUES (10, 8, 0, 1, '新增空白产品', '', '<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	公司拥有领先的技术和经验，目前是引领该行业的先锋企业。经过不断的试验，努力的改正错误，我们的客户在过去的几年逐步的增长。<br />\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	上海腾岩信息科技有限公司是一家专注互联网技术服务的高新科技公司，公司成立以来已经在众多领域取得了骄人的成绩，同时我们与国际、国内众多ISP服务商、软件开发商及IT服务企业结为战略联盟和合作伙伴。</div>\r\n<br style="font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; " />\r\n<img alt="" src="http://demo-l1.com/upload/other/images/20121017_130451.jpg" style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; width: 680px; height: 278px; " /><br style="font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; " />\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	腾岩科技的服务范围包括：互联网基础应用、网站建设、企事业信息管理系统、数据库开发、B/S软件研发等。</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	我们的互联网技术服务范围已经涵盖互联网所涉及的全部服务与技术支持，如域名注册、企业邮局、邮件群发、网站空间、数据库、服务器租用托管业务、网站建设、营运咨询、管理维护等等。</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	&nbsp;</div>\r\n<div style="margin: 0px; padding: 0px; border: 0px; font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: left; ">\r\n	腾岩科技专注以互联网领域的信息技术服务为公司的主要发展之路,使用户在享受信息科技发展最新成果的同时不断获得最大的收益。 一个能从别人的观念来看事情，能了解别人心灵活的人，永远不必为自己的前途担心。&nbsp;</div>\r\n', '', 1, 1, '2012-10-16 20:39:37', '2012-10-21 20:07:45', '0000-00-00 00:00:00', 0, 10);

-- --------------------------------------------------------

-- 
-- 表的结构 `productpic`
-- 

CREATE TABLE `productpic` (
  `id_prodpic` int(11) NOT NULL auto_increment,
  `id_prodinfo` int(11) NOT NULL,
  `id_hr` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `intro` text NOT NULL,
  `url` varchar(250) NOT NULL,
  `opicname` varchar(250) NOT NULL,
  `spicname` varchar(250) NOT NULL,
  `dele` int(1) NOT NULL default '1',
  `type` varchar(3) NOT NULL,
  `indate` datetime NOT NULL,
  `modate` datetime NOT NULL,
  `deldate` datetime NOT NULL,
  `browsecount` int(11) NOT NULL,
  PRIMARY KEY  (`id_prodpic`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- 
-- 导出表中的数据 `productpic`
-- 

INSERT INTO `productpic` VALUES (2, 1, 1, '', '', '', 'nopic.gif', '', 1, 'GIF', '2012-10-12 18:30:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `productpic` VALUES (3, 2, 1, 'eeee', '222', '', 'nopic.gif', '', 1, 'GIF', '2012-10-12 19:37:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `productpic` VALUES (11, 2, 1, 'FDSF', 'DSFDS', '', '1350042467.gif', '', 1, 'GIF', '2012-10-12 19:47:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `productpic` VALUES (14, 10, 1, '', '', '', '1350391719.jpg', '', 1, 'JPG', '2012-10-16 20:46:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);
INSERT INTO `productpic` VALUES (16, 9, 1, '', '', '', '1350398278.jpg', '', 1, 'JPG', '2012-10-16 20:47:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `siteset`
-- 

CREATE TABLE `siteset` (
  `id_siteset` int(11) NOT NULL auto_increment,
  `lang` int(1) NOT NULL default '1',
  `title` text NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `otherheader` text NOT NULL,
  `iscopy` int(1) NOT NULL default '0',
  `rmailbox` varchar(50) NOT NULL,
  `smailbox` varchar(50) NOT NULL,
  `smailboxpass` varchar(50) NOT NULL,
  `icp` varchar(25) NOT NULL,
  `mapcode` text NOT NULL,
  `statistics` text NOT NULL,
  `isstyle` varchar(8) NOT NULL,
  PRIMARY KEY  (`id_siteset`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `siteset`
-- 

INSERT INTO `siteset` VALUES (1, 1, '上海腾岩信息科技有限公司', '上海腾岩信息科技有限公司', '上海腾岩信息科技有限公司', '', 0, '', '', '', '', '<iframe height="300" marginheight="0" src="http://ditu.google.cn/maps?f=d&source=s_d&saddr=%E4%B8%8A%E6%B5%B7%E5%B8%82%E6%9D%BE%E6%B1%9F%E5%8F%B6%E6%94%BF%E8%B7%AF451%E5%BC%84+(%E4%B8%8A%E6%B5%B7%E5%8F%8C%E9%AB%98%E5%95%86%E5%8A%A1%E5%B9%BF%E5%9C%BA)&daddr=&geocode=CQ8-uSs0BPD-Fb8p2AEd5is7ByGob0MM0C_KZA&aq=&sll=31.096121,121.519433&sspn=0.435689,0.617294&hl=zh-CN&brcurrent=3,0x35b2885df9d1a2c5:0x6368612615c7a5b,0,0x35b2633be24b87d5:0xde5e102b16be8828%3B5,0,0&mra=pd&ie=UTF8&t=m&z=16&output=embed" frameborder="0" width="980" marginwidth="0" scrolling="no"></iframe>', '', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `title`
-- 

CREATE TABLE `title` (
  `id_title` int(11) NOT NULL auto_increment,
  `title` varchar(25) NOT NULL,
  `lang` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id_title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- 导出表中的数据 `title`
-- 

INSERT INTO `title` VALUES (15, 'q', 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `webmenu`
-- 

CREATE TABLE `webmenu` (
  `id_webmenu` int(11) NOT NULL auto_increment,
  `lang` int(1) NOT NULL default '1',
  `name` varchar(25) NOT NULL,
  `url` text NOT NULL,
  `dele` int(1) NOT NULL default '1',
  `fatherid` int(11) NOT NULL,
  `level` int(1) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY  (`id_webmenu`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- 
-- 导出表中的数据 `webmenu`
-- 

INSERT INTO `webmenu` VALUES (1, 1, '网站首页----HOME', '/', 1, 0, 1, 8);
INSERT INTO `webmenu` VALUES (2, 1, '关于我们----About us', '/about/aboutus.php', 1, 0, 1, 7);
INSERT INTO `webmenu` VALUES (3, 1, '产品中心----Products', '/product/products.php', 1, 0, 1, 6);
INSERT INTO `webmenu` VALUES (4, 1, '新闻中心----News', '/news/news.php', 1, 0, 1, 5);
INSERT INTO `webmenu` VALUES (5, 1, '联系我们----Contact us', '/contactus/contactus.php', 1, 0, 1, 4);
INSERT INTO `webmenu` VALUES (11, 1, '公司介绍----Introduction', '/about/intro.php', 1, 2, 2, 0);
INSERT INTO `webmenu` VALUES (12, 1, '关于我们----About us', '/about/aboutus.php', 1, 2, 2, 0);
INSERT INTO `webmenu` VALUES (13, 1, '总经理致辞----CEO''s Message', '/about/ceomessage.php', 1, 2, 2, 0);
INSERT INTO `webmenu` VALUES (14, 1, '产品中心----Products', '/product/products.php', 1, 3, 2, 0);
INSERT INTO `webmenu` VALUES (15, 1, '资料下载----PDF download', '/product/productpdf.php', 1, 3, 2, 0);
INSERT INTO `webmenu` VALUES (16, 1, '我们的工厂----Our factory', '/product/ourfactory.php', 1, 3, 2, 0);
INSERT INTO `webmenu` VALUES (17, 1, '公司新闻----Company news', '/news/companynews.php', 1, 4, 2, 0);
INSERT INTO `webmenu` VALUES (18, 1, '产品新闻----Product news', '/news/productnews.php', 1, 4, 2, 0);
INSERT INTO `webmenu` VALUES (19, 1, '加入我们----Join us', '/news/joinus.php', 1, 4, 2, 0);

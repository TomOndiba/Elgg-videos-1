<?php
/**
 * List most recent videos on group profile page
 *	Author : Sarath C | Team Webgalli
 *	Team Webgalli | Elgg developers and consultants
 *	Mail : info [at] webgalli [dot] com
 *	Web	: http://webgalli.com
 *	Skype : 'team.webgalli'
 *	@package Elgg-videos
 * 	Plugin info : Upload/ Embed videos. Save uploaded videos in youtube and save your bandwidth and server space
 *	Licence : GNU2
 *	Copyright : Team Webgalli 2011-2015
 */

$group = elgg_get_page_owner_entity();

if ($group->videos_enable == "no") {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "videos/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'videos',
	'container_guid' => elgg_get_page_owner_guid(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
	'no_results' => elgg_echo('videos:none'),	
);
$content = elgg_list_entities($options);
elgg_pop_context();

$new_link = elgg_view('output/url', array(
	'href' => "videos/add/$group->guid",
	'text' => elgg_echo('videos:add'),
	'is_trusted' => true,	
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('videos:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));

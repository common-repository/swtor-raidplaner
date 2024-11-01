=== Plugin Name ===
Contributors: veteres
Donate link: http://veteres-unlimited.de/raidplaner/wordpress-plugin/
Tags: swtor, raider, mmorpg
Requires at least: 3.0.1
Tested up to: 3.8.1
Stable tag: 1.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Raidplaner plugin for the MMORPG Starwars: The old Republic. 

== Description ==

Because there was no raid planer for SWTOR we develop a simple one to use it as a plugin for wordpress.
The SW:ToR - Raidplaner is a plugin to add a raid planer to a guild site based on wordpress for the MMORPG 'Starwars: The old Republic'.
See the raid planer in action at http://veteres-unlimited.de/raidplaner/


**Features:**

* **Simple charackter organisation:** The raider will add several fields to the user profiles to manage the different characters of a player.
* **Waitlist:** A user can add himself on a waitlist to optionaly raid or to the raidlist if he wants to raid.
* **Simple raidmanagement:** The raid leader can manage the kind of user entries. He can set the amount of needed players. Additionaly he can define that the user can only set himself to a waitlist or directly to the raidlist.
* **Simple raidmanagement II:** The raid leader can simple copy older raids, edit the date and store it as a new one.
* **Raidpoints:** Each time the user will be set to a raidlist (by himself or the raidlead) he get one raidpoint. This shows how much he is rading (no DKP).
* **Widget:** Show the next raids within your widget bar.
* **Raidleaders:** Access the backend as admin or editor.
* **s2Members compatible:** If s2Members-Plugin http://wordpress.org/extend/plugins/s2member/ is installed you can allow guests to be part of a raid. In this case subscribers would be marked as guests and s2Members of level 1 or higher would be shown normal within the raidlists. This is setable by the options page.
* **Event calender compatible:** If EventCalendar-Plugin http://wordpress.org/extend/plugins/wp-events-calendar/ is installed the Raider will show the big calender in front of the Raidlists and enter the raid to the calender, also shown within the event calender widget.
* **Lowlevel support:** By define the level of the members of a raid the raidplaner can also be used to plan e.g. flashpoints at lower levels or other events.
* **Archive:** The raids in the past are stored within the archive.
* **Options:** Choose which side should raid: The imperium, the recpublic or both.

**How To Use?**

First of all each player how wants to raid have to edit his user profile. By doing this he have to edit the several fields at the end of the profile to enter his swtor charackters.
After done this another user with editor-privilegs (or higher) add a raid within the raidplaner backend. The first users can now add one of the profile-entered charackters to the raid.


== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `[raidplaner]` in a site of your homepage
4. (Optional) Place the raider widget to your sidebar.

== Frequently Asked Questions ==

**How do I using the guest option?**

If you are using s2Memeber-Plugin you can allow guest to raid with you.
While normal guild members are minimal s2Memeber of Level 1 and Guests are normal wordpress subscribers
the raider will show all raiders which are subscribers as 'Guest'.

**How do I get the calender (widget and overview)?**

If you install the 'event calender'-Plugin the raids will also be shown within the calendar.
The tag [raidplaner] will also show the calender in front of the raidlist.

**After Update 1.1.0 my chars are gone**
The update set the level maximum to 55 and changing the "55+" tag to "50-55". So, update the chars within the profil and everything is fine.

**Who can I ask if I found a bug or have a question?**
Just write ceo@veteres-unlimited.de! 

== Screenshots ==

1. Showing the users profile addon to enter the charackter informations.
2. Showing the backend to add a raid.

== Changelog ==

= 1.1.2 =
* Only problems with the check in.

= 1.1.1 =
* Fix some code issues which allows sql injection (thanks to ZAM from buffed.de)
* Add some little advertise

= 1.1.0 =
* Bugfix several bugs for special chars within charackter names.
* Expand the charackter to level 55 (the player chars have to be updated).
* The author of a raid (who add them) can now edit the raid list within front end.
* syncronising calender weekdays of event calender and the date entry javascript at the backend.
* bugfix: If edit a char now you can only get on waitlist if only the author can book.
* Added a tag who creates the raid within the frontend.
* Add a link to the raid details within the frontend to the users profil to the backend.

= 1.0.9 =
* Adding some css-classes to the th element of the raid overview table to allow better css formating.
* Chaning the restriction of the level of a raid charackter. If the level is bigger he can join now.
* Fix a bug which appears if you want to add a fourth twink to a raid.
* Fixing a bug so the raids will now be sorted on appearing date within the overview and widget.
* Adding a forwarding script to the frontend which automatic switches to the raid details after adding himself to a raid.
* Sorting the users list at the backend raid details.
* Fix a bug adding slashes to special chars within raid description.
* Users can add (and edit) a comment when the join the raid. (Add .sr_info {} in your style sheet to format the tooltip comment.)

= 1.0.8 =
* Adding a repository banner.

= 1.0.7 =
* Changing the GET-Algo to be compatible with standard permalinks.

= 1.0.6 =
* Bugfix a date bug.

= 1.0.5 =
* Adding class icons to the raid- and waitlist on the detail view.

= 1.0.4 =
* Bugfix: Change another include path.

= 1.0.3 =
* Bugfix: Notice a changed path to the includes.

= 1.0.2 =
* Updatet the readme.txt / the repository description

= 1.0.1 =
* Updatet the readme.txt / the repository description

= 1.0 =
* Initial version

== Upgrade Notice ==

= 1.1.1 =
* Fix some code issues which allows sql injection (thanks to ZAM from buffed.de)
* Add some little advertise

= 1.1.0 =
* Bugfix several bugs for special chars within charackter names.
* Expand the charackter to level 55 (the player chars have to be updated).
* The author of a raid (who add them) can now edit the raid list within front end.
* syncronising calender weekdays of event calender and the date entry javascript at the backend.
* bugfix: If edit a char now you can only get on waitlist if only the author can book.
* Added a tag who creates the raid within the frontend.
* Add a link to the raid details within the frontend to the users profil to the backend.

= 1.0.9 =
* Adding some css-classes to the th element of the raid overview table to allow better css formating.
* Chaning the restriction of the level of a raid charackter. If the level is bigger he can join now.
* Fix a bug which appears if you want to add a fourth twink to a raid.
* Fixing a bug so the raids will now be sorted on appearing date within the overview and widget.
* Adding a forwarding script to the frontend which automatic switches to the raid details after adding himself to a raid.
* Sorting the users list at the backend raid details.
* Fix a bug adding slashes to special chars within raid description.
* Users can add (and edit) a comment when the join the raid. (Add .sr_info {} in your style sheet to format the tooltip comment.)

= 1.0.8 =
* Adding a repository banner.

= 1.0.7 =
* Changing the GET-Algo to be compatible with standard permalinks.

= 1.0.6 =
Bugfix a date bug.

= 1.0.5 =
* Adding class icons to the raid- and waitlist on the detail view.

= 1.0.4 =
* Bugfix: Change another include path.

= 1.0.3 =
* Bugfix: Notice a changed path to the includes.


= 1.0.2 =
* Updatet the readme.txt / the repository description

= 1.0.1 =
* Updatet the readme.txt / the repository description

= 1.0 =
* Initial version
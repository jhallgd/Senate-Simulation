# Data Dictionary
## Database: senate_sim

## Committees (co)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| co_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| co_name          |   | TEXT      | NOT NULL                                    |                          |
| co_location      |   | TEXT      | NOT NULL                                    |                          |


## Parties (pa)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| pa_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| pa_name          |   | TEXT      | NOT NULL                                    |                          |
| pa_location      |   | TEXT      | NOT NULL                                    |                          |
| pa_color         |   | TEXT      | NOT NULL                                    |                          |


## Bills (bl)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| bl_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| bl_title         |   | TEXT      | NOT NULL                                    |                          |
| bl_short_text    |   | LONGTEXT  | NOT NULL                                    |                          |
| bl_url           |   | TEXT      |                                             |                          |


## Senators (se)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| se_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| se_first_name    |   | TEXT      | NOT NULL                                    |                          |
| se_last_name     |   | TEXT      | NOT NULL                                    |                          |
| se_title         |   | TEXT      | NOT NULL                                    |                          |
| se_pa_id         | F | INT       |                                             | Parties                  |



## Votes (vo)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| vo_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| vo_vote          |   | TEXT      | NOT NULL                                    |                          |
| vo_se_id         | F | INT       | NOT NULL                                    | Senators                 |
| vo_bl_id         | F | INT       | NOT NULL                                    | Bills                    |



## PartyViewTypes (pvt)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| pvt_id           | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| pvt_view         |   | TEXT      | NOT NULL                                    |                          |
| pvt_color        |   | TEXT      | NOT NULL                                    |                          |


## PartiesBills (pb)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| pb_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| pb_pvt_id        | F | INT       | UNSIGNED NOT NULL                           | PartyViewTypes           |
| pb_pa_id         | F | INT       | UNSIGNED NOT NULL                           | Parties                  |
| pb_bl_id         | F | INT       | UNSIGNED NOT NULL                           | Bills                    |



## CommitteesBills (cb)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| cb_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| cb_co_id         | F | INT       | UNSIGNED NOT NULL                           | Committees               |
| cb_bl_id         | F | INT       | UNSIGNED NOT NULL                           | Bills                    |



## CommitteePositionTypes (cpt)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| cpt_id           | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| cpt_name         |   | TEXT      | NOT NULL                                    |                          |
| cpt_order        |   | INT       | NOT NULL                                    |                          |



## SenatorsCommittees (sc)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| sc_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| sc_cpt_id        | F | INT       | UNSIGNED NOT NULL                           | CommitteePositionTypes   |
| sc_se_id         | F | INT       | UNSIGNED NOT NULL                           | Senators                 |
| sc_co_id         | F | INT       | UNSIGNED NOT NULL                           | Committees               |



## VoteTypes (vt)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| vt_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| vt_name          |   | TEXT      | NOT NULL                                    |                          |
| vt_color         |   | TEXT      | NOT NULL                                    |                          |



## Votes (vo)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| vo_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| vo_vt_id         | F | INT       | UNSIGNED NOT NULL                           | VoteTypes                |
| vo_se_id         | F | INT       | UNSIGNED NOT NULL                           | Senators                 |
| vo_bl_id         | F | INT       | UNSIGNED NOT NULL                           | Bills                    |


## Admins (ad)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| ad_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| ad_username      |   | TEXT      | NOT NULL                                    |                          |
| ad_password      |   | TEXT      | NOT NULL                                    |                          |


## Settings (st)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| st_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| st_start_session |   | BOOLEAN   |                                             |                          |
| st_active_bill   | F | INT       | UNSIGNED                                    | Bills                    |
| st_default_vt    | F | INT       | UNSIGNED NOT NULL                           | VoteTypes                |
| st_default_pvt   | F | INT       | UNSIGNED NOT NULL                           | PartyViewTypes           |

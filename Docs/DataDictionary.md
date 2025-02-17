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



## Settings (se)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| se_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| se_active_bill   |   | INT       | NOT NULL                                    |                          |


## PartiesBills (pb)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| pb_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| pb_view          |   | TEXT      | NOT NULL                                    |                          |
| pb_pa_id         | F | INT       | NOT NULL                                    | Parties                  |
| pb_bl_id         | F | INT       | NOT NULL                                    | Bills                    |

## CommitteesBills (cb)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| cb_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| cb_co_id         | F | INT       | NOT NULL                                    | Committees               |
| cb_bl_id         | F | INT       | NOT NULL                                    | Bills                    |

## CommitteePositionTypes (cpt)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| cpt_id           | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| cpt_name         |   | TEXT      | UNSIGNED AUTO_INCREMENT                     |                          |
| cpt_order        |   | INT       | NOT NULL                                    |                          |


## SenatorsCommittees (sc)
| Attribute        |Key| Data Type | Options                                     | Linked Table             |
| ---------------- |---| --------- | ------------------------------------------- | ------------------------ |
| sc_id            | P | INT       | UNSIGNED AUTO_INCREMENT                     |                          |
| sc_cpt_id        | F | INT       | UNSIGNED AUTO_INCREMENT                     | CommitteePositionTypes   |
| sc_se_id         | F | INT       | NOT NULL                                    | Senators                 |
| sc_co_id         | F | INT       | NOT NULL                                    | Committees               |

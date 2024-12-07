# Database Documentation for Dynamic Fee System

## Overview

The Dynamic Fee System uses a database consisting of the following tables:

1. fee_presets
2. services
3. thresholds
4. fee_percentages

## Table Details

### 1. fee_presets Table

This table stores the predefined fee settings.

| Column | Type | Description |
|--------|------|-------------|
| id | bigint(20) unsigned | Unique identifier (Primary Key) |
| name | varchar(255) | Name of the fee preset |
| description | text | Description of the fee preset (nullable) |
| base_percentage | decimal(5,2) | Base percentage for the fee |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

### 2. services Table

This table stores the available services in the system.

| Column | Type | Description |
|--------|------|-------------|
| id | bigint(20) unsigned | Unique identifier (Primary Key) |
| name | varchar(255) | Name of the service |
| description | text | Description of the service (nullable) |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

### 3. thresholds Table

This table stores the thresholds used to determine fee percentages.

| Column | Type | Description |
|--------|------|-------------|
| id | bigint(20) unsigned | Unique identifier (Primary Key) |
| min_spent | decimal(10,2) | Minimum amount spent |
| max_spent | decimal(10,2) | Maximum amount spent (nullable for open-ended upper limit) |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

### 4. fee_percentages Table

This table stores the specific fee percentages for each combination of fee preset, service, and threshold.

| Column | Type | Description |
|--------|------|-------------|
| id | bigint(20) unsigned | Unique identifier (Primary Key) |
| fee_preset_id | bigint(20) unsigned | Foreign key to fee_presets table |
| service_id | bigint(20) unsigned | Foreign key to services table |
| threshold_id | bigint(20) unsigned | Foreign key to thresholds table |
| percentage | decimal(5,2) | The applied fee percentage |
| created_at | timestamp | Record creation time |
| updated_at | timestamp | Record last update time |

## Relationships between Tables

1. The `fee_percentages` table is related to the `fee_presets` table through `fee_preset_id`.
2. The `fee_percentages` table is related to the `services` table through `service_id`.
3. The `fee_percentages` table is related to the `thresholds` table through `threshold_id`.

These relationships allow for the precise determination of the fee percentage for each combination of fee preset, service, and threshold.

## Additional Notes

- All tables use `id` as the primary key with auto-increment.
- All tables include `created_at` and `updated_at` columns to track record creation and update times.
- Foreign key constraints are used in the `fee_percentages` table to ensure data integrity and prevent invalid references.

## Database Usage

When calculating fees for a specific transaction:

1. The fee preset is selected from the `fee_presets` table.
2. The service used is identified from the `services` table.
3. The appropriate threshold is found in the `thresholds` table based on the total amount spent.
4. The specific fee percentage is looked up in the `fee_percentages` table using the identifiers from the previous steps.
5. If no specific percentage is found, the base percentage from the fee preset is used.

This structure allows for great flexibility in defining fees based on a variety of factors.


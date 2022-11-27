### APP KBANK VIETNAM DOCUMENT REPORT
<p align="center"><img src="https://kbank-vn.beta.powersell.net/images/kbank_logo.svg" width="400"></p>

## Document Report

#### 1. Console structure
```
├── kbank-vn
│   ├── App
│   ├── composer.json
|   ├── Modules
|   |   ├── KbankApp
|   |   |   ├── Console
|   │   │   |   ├── KbankCrawlAllData.php
|   │   │   |   ├── KbankExportAllData.php
|   │   │   |   ├── KbankExportData.php
|   │   │   |   ├── KbankExportMonthlyAllData.php
|   │   │   |   └── UpdateMonthlyReportStatus.php
|   ├── Console
|   |   |__Kernel.php
|   |   
│   ├── public
│   └── ... (default Laravel directory structure)
```
#### 2. Command crontab config in file App\Console\Kernel.php

Create crontab in server
```bash
crontab -e
```
and write
```
* * * * * sudo -H -u www bash -c 'cd /home/www/kbank-vn/current && php artisan schedule:run >> /dev/null 2>:&1'
```

##### Commands in file Kernel.php
Crontab run realtime (5 minute)
```
kbank:crawl_all_data
```
```
kbank:export_all
```
```
kbank:export_monthly_all
```

Crontab run realtime (1 month)
```
kbank:update-report-status
```

Crontab trigger monthly report
```
kbank:export_monthly_all
```

Crontab trigger first report
```
kbank:export_all
```

Crontab check status monthly report
```
kbank:update-report-status
```

#### 3. Commands run manual

#### Move to **app's directory** and run

Export application by shop id (ex: shop_id = 1)
```bash

php artisan kbank:export 1
```

Trigger Monthly Report
```bash

php artisan export:trigger_monthly_report
```
Check First Report
```bash

php artisan kbank:export_all
```

Check Monthly Report
```bash

php artisan kbank:export_monthly_all
```

Update statu monthly report
```bash

php artisan kbank:update-report-status
```

#### Re-Generate all report 
Select All shop is active first report
```
SELECT * FROM `shops` WHERE scan_status = 1 and status_processing = 1 and status = 'pending';
```

Select All shop is active monthly report
```
SELECT * FROM `shops` 
WHERE scan_status = 1 and status_processing = 1 and status_monthly = 'pending'
    AND CURRENT_TIMESTAMP BETWEEN report_monthly_start_time AND report_monthly_end_time;
```

Run update mysql table shops (not reset data)
```
UPDATE `shops` SET `status_processing` = 0 WHERE scan_status = 1 and status_processing = 1;
```

Run update mysql table shops (reset data first report in 12 month)
```
UPDATE `shops`
SET status = 'pending', status_processing = 1, scan_status = 1
WHERE id = ?
```

Run update mysql table shops (reset data monthly report in 12 month)
```
UPDATE shops
SET status_monthly = 'pending', status_processing = 1, scan_status = 1
	-- , report_monthly_start_time = DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 month),
	-- report_monthly_end_time = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 month)
WHERE id = ?
```

Format : Y-m-d (2019-06-01)

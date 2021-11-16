<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BLPro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "DROP PROCEDURE IF EXISTS `PR_BL`;

          CREATE  PROCEDURE `PR_BL`(IN `v_frm_date` DATE, IN `v_till_date` DATE, IN `bid` INT)
             BEGIN
              DECLARE v_stp int;
            DECLARE v_cnt int;
            SET v_stp = 0;

            Create temporary table BLS
            (`id` INT UNSIGNED NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`),
            AID nvarchar(50)  ,
            ADBBEF decimal(18,2) ,
            ACRBEF  decimal(18,2) ,
            ADB  decimal(18,2) ,
            ACR decimal(18,2) ,
            ADBBEFc decimal(18,2) ,
            ACRBEFc  decimal(18,2) ,
            ADBc  decimal(18,2) ,
            ACRc decimal(18,2) ,
            stp int
            ) ENGINE = memory;
                insert into BLS (AID,ADBBEF,ACRBEF,ADB,ACR,ADBBEFc,ACRBEFc,ADBc,ACRc,stp)
            SELECT        trans_accno ,
            CASE WHEN trans_date < v_frm_date  THEN SUM(trans_db) ELSE 0 END AS ADBBEF,
            CASE WHEN trans_date < v_frm_date  THEN SUM(trans_cr) ELSE 0 END AS ACRBEF,
            CASE WHEN trans_date >= v_frm_date and trans_date <= v_till_date THEN SUM(trans_db) ELSE 0 END AS ADB,
            CASE WHEN trans_date >= v_frm_date and trans_date <= v_till_date THEN SUM(trans_cr) ELSE 0 END AS ACR,

            CASE WHEN trans_date < v_frm_date  THEN SUM(trans_dbc) ELSE 0 END AS ADBBEFc,
            CASE WHEN trans_date < v_frm_date  THEN SUM(trans_crc) ELSE 0 END AS ACRBEFc,
            CASE WHEN trans_date >= v_frm_date and trans_date <= v_till_date THEN SUM(trans_dbc) ELSE 0 END AS ADBc,
            CASE WHEN trans_date >= v_frm_date and trans_date <= v_till_date THEN SUM(trans_crc) ELSE 0 END AS ACRc,

            v_stp
            FROM            trans_master
                where trans_master.trans_cmpy=bid
            GROUP BY trans_accno,trans_date;
                SET v_cnt = (SELECT COUNT(*) FROM BLS);
            label1: WHILE v_cnt > 0 DO
            SET v_stp = v_stp + 1;
              INSERT INTO BLS  (AID, ADBBEF,ACRBEF,ADB, ACR,  ADBBEFc,ACRBEFc,ADBc, ACRc,stp)
            SELECT         nv_accounts.`acc_belongTo`,
            SUM(ADBBEF) , SUM(ACRBEF) , SUM(ADB) , SUM(ACR) ,
            SUM(ADBBEFc) , SUM(ACRBEFc) , SUM(ADBc) , SUM(ACRc)
            , v_stp
            FROM            BLS as ts  LEFT OUTER JOIN
                                      nv_accounts ON ts.AID =  nv_accounts.`acc_no` and nv_accounts.`acc_Cmpy_id` = bid
            where ts.stp = v_stp - 1  and  nv_accounts.`acc_belongTo` is not null
            GROUP BY  nv_accounts.`acc_belongTo`, ts.stp;
            SET v_cnt = (SELECT COUNT(*) FROM BLS WHERE stp = v_stp - 1 );

                END WHILE label1;
                 select AID as AccID,

            SUM(ADBBEF) as Bef_Db,SUM(ACRBEF) as Bef_Cr,(SUM(ADBBEF) - SUM(ACRBEF)) as Bef_Bal,
            case when SUM(ADBBEF) - SUM(ACRBEF) >= 0 then SUM(ADBBEF) - SUM(ACRBEF) else 0  end as Bef_BalDb,
            case when SUM(ADBBEF) - SUM(ACRBEF) < 0 then abs(SUM(ADBBEF) - SUM(ACRBEF)) else 0  end as Bef_BalCr,

            SUM(ADB) as Dur_Db,SUM(ACR) as Dur_Cr,(SUM(ADB) - SUM(ACR)) as  Dur_Bal,
            case when SUM(ADB) - SUM(ACR) >= 0 then SUM(ADB) - SUM(ACR) else 0  end as  Dur_BalDb,
            case when SUM(ADB) - SUM(ACR) < 0 then abs(SUM(ADB) - SUM(ACR)) else 0  end as   Dur_BalCr,


            SUM(ADBBEF)+ SUM(ADB) as Tot_DB,SUM(ACRBEF) + SUM(ACR) as Tot_Cr ,(SUM(ADBBEF)+SUM(ADB)) - (SUM(ACRBEF) +SUM(ACR)) as Tot_Bal,
            case when (SUM(ADBBEF)+ SUM(ADB)) - (SUM(ACRBEF) +SUM(ACR)) >= 0 then (SUM(ADBBEF)+ SUM(ADB)) - (SUM(ACRBEF) +SUM(ACR)) else 0  end as Tot_BalDb,
            case when (SUM(ADBBEF)+ SUM(ADB)) - (SUM(ACRBEF) +SUM(ACR)) < 0 then abs((SUM(ADBBEF)+ SUM(ADB)) - (SUM(ACRBEF) +SUM(ACR))) else 0  end as Tot_BalCr,

            SUM(ADBBEFc) as Bef_Dbc,SUM(ACRBEFc) as Bef_Crc,(SUM(ADBBEFc) - SUM(ACRBEFc)) as Bef_Balc,
            case when SUM(ADBBEFc) - SUM(ACRBEFc) >= 0 then SUM(ADBBEFc) - SUM(ACRBEFc) else 0  end as Bef_BalDbc,
            case when SUM(ADBBEFc) - SUM(ACRBEFc) < 0 then abs(SUM(ADBBEFc) - SUM(ACRBEFc)) else 0  end as Bef_BalCrc,

            SUM(ADBc) as Dur_Dbc,SUM(ACRc) as Dur_Crc,(SUM(ADBc) - SUM(ACRc)) as  Dur_Balc,
            case when SUM(ADBc) - SUM(ACRc) >= 0 then SUM(ADBc) - SUM(ACRc) else 0  end as  Dur_BalDbc,
            case when SUM(ADBc) - SUM(ACRc) < 0 then abs(SUM(ADBc) - SUM(ACRc)) else 0  end as   Dur_BalCrc,


            SUM(ADBBEFc)+ SUM(ADBc) as Tot_DBc,SUM(ACRBEFc) + SUM(ACRc) as Tot_Crc ,(SUM(ADBBEFc)+SUM(ADBc)) - (SUM(ACRBEFc) +SUM(ACRc)) as Tot_Balc,
            case when (SUM(ADBBEFc)+ SUM(ADBc)) - (SUM(ACRBEFc) +SUM(ACRc)) >= 0 then (SUM(ADBBEFc)+ SUM(ADBc)) - (SUM(ACRBEFc) +SUM(ACRc)) else 0  end as Tot_BalDbc,
            case when (SUM(ADBBEFc)+ SUM(ADBc)) - (SUM(ACRBEFc) +SUM(ACRc)) < 0 then abs((SUM(ADBBEFc)+ SUM(ADBc)) - (SUM(ACRBEFc) +SUM(ACRc))) else 0  end as Tot_BalCrc,

            case when `acc_ismaster` = 0 then SUM(ADBBEF) else 0 end  as DBef_Db,
            case when `acc_ismaster` = 0 then SUM(ACRBEF) else 0 end  as DBef_Cr,
            case when `acc_ismaster` = 0 then  (SUM(ADBBEF) - SUM(ACRBEF)) else 0 end  as DBef_Bal,
            case when `acc_ismaster` = 0 then
            case when SUM(ADBBEF) - SUM(ACRBEF) >= 0 then SUM(ADBBEF) - SUM(ACRBEF) else 0  end
            else 0 end as DBef_BalDb,
            case when `acc_ismaster` = 0 then
            case when SUM(ADBBEF) - SUM(ACRBEF) < 0 then abs(SUM(ADBBEF) - SUM(ACRBEF)) else 0  end
            else 0 end as DBef_BalCr,

            case when `acc_ismaster` = 0 then SUM(ADB) else 0 end as DDur_Db,
            case when `acc_ismaster` = 0 then SUM(ACR) else 0 end as DDur_Cr,
            case when `acc_ismaster` = 0 then (SUM(ADB) - SUM(ACR)) else 0 end as  DDur_Bal,
            case when `acc_ismaster` = 0 then
            case when SUM(ADB) - SUM(ACR) >= 0 then SUM(ADB) - SUM(ACR) else 0  end
            else 0 end as  DDur_BalDb,
            case when `acc_ismaster` = 0 then
            case when SUM(ADB) - SUM(ACR) < 0 then abs(SUM(ADB) - SUM(ACR)) else 0  end
            else 0 end as   DDur_BalCr,


            case when `acc_ismaster` = 0 then SUM(ADBBEF)+ SUM(ADB)  else 0 end as DTot_DB,
            case when `acc_ismaster` = 0 then SUM(ACRBEF) + SUM(ACR)  else 0 end as DTot_Cr ,
            case when `acc_ismaster` = 0 then (SUM(ADBBEF)+SUM(ADB)) - (SUM(ACRBEF) +SUM(ACR))  else 0 end as DTot_Bal,
            case when `acc_ismaster` = 0 then case when (SUM(ADBBEF)+ SUM(ADB)) - (SUM(ACRBEF) +SUM(ACR)) >= 0 then (SUM(ADBBEF)+ SUM(ADB)) - (SUM(ACRBEF) +SUM(ACR)) else 0  end  else 0 end as DTot_BalDb,
            case when `acc_ismaster` = 0 then case when (SUM(ADBBEF)+ SUM(ADB)) - (SUM(ACRBEF) +SUM(ACR)) < 0 then abs((SUM(ADBBEF)+ SUM(ADB)) - (SUM(ACRBEF) +SUM(ACR))) else 0  end  else 0 end as DTot_BalCr,

            case when `acc_ismaster` = 0 then SUM(ADBBEFc)  else 0 end as DBef_Dbc,
            case when `acc_ismaster` = 0 then SUM(ACRBEFc) else 0 end as DBef_Crc,
            case when `acc_ismaster` = 0 then (SUM(ADBBEFc) - SUM(ACRBEFc)) else 0 end as DBef_Balc,
            case when `acc_ismaster` = 0 then case when SUM(ADBBEFc) - SUM(ACRBEFc) >= 0 then SUM(ADBBEFc) - SUM(ACRBEFc) else 0  end else 0 end as DBef_BalDbc,
            case when `acc_ismaster` = 0 then case when SUM(ADBBEFc) - SUM(ACRBEFc) < 0 then abs(SUM(ADBBEFc) - SUM(ACRBEFc)) else 0  end else 0 end as DBef_BalCrc,

            case when `acc_ismaster` = 0 then SUM(ADBc) else 0 end as DDur_Dbc,
            case when `acc_ismaster` = 0 then SUM(ACRc) else 0 end as DDur_Crc,
            case when `acc_ismaster` = 0 then (SUM(ADBc) - SUM(ACRc)) else 0 end as DDur_Balc,
            case when `acc_ismaster` = 0 then case when SUM(ADBc) - SUM(ACRc) >= 0 then SUM(ADBc) - SUM(ACRc) else 0  end else 0 end as DDur_BalDbc,
            case when `acc_ismaster` = 0 then case when SUM(ADBc) - SUM(ACRc) < 0 then abs(SUM(ADBc) - SUM(ACRc)) else 0  end  else 0 end as DDur_BalCrc,


            case when `acc_ismaster` = 0 then SUM(ADBBEFc)+ SUM(ADBc) else 0 end as DTot_DBc,
            case when `acc_ismaster` = 0 then SUM(ACRBEFc) + SUM(ACRc) else 0 end as DTot_Cr ,
            case when `acc_ismaster` = 0 then (SUM(ADBBEFc)+SUM(ADBc)) - (SUM(ACRBEFc) +SUM(ACRc)) else 0 end as DTot_Bacl,
            case when `acc_ismaster` = 0 then case when (SUM(ADBBEFc)+ SUM(ADBc)) - (SUM(ACRBEFc) +SUM(ACRc)) >= 0 then (SUM(ADBBEFc)+ SUM(ADBc)) - (SUM(ACRBEFc) +SUM(ACRc)) else 0  end else 0 end as DTot_BalDbc,
            case when `acc_ismaster` = 0 then case when (SUM(ADBBEFc)+ SUM(ADBc)) - (SUM(ACRBEFc) +SUM(ACRc)) < 0 then abs((SUM(ADBBEFc)+ SUM(ADBc)) - (SUM(ACRBEFc) +SUM(ACRc))) else 0  end else 0 end as DTot_BalCrc,



            nv_accounts.`acc_no`,nv_accounts.`acc_name`,nv_accounts.`acc_belongTo`,nv_accounts.`acc_finalReport`,nv_accounts.`acc_Cmpy_id`,nv_accounts.`acc_ismaster`
            from BLS  Balancesheet
            LEFT OUTER JOIN  nv_accounts
                on Balancesheet.AID =  nv_accounts.acc_no
                and nv_accounts.acc_Cmpy_id = bid
            GROUP BY Balancesheet.AID
                  ,nv_accounts.`acc_no`
                  ,nv_accounts.`acc_name`
                  ,nv_accounts.`acc_belongTo`
                  ,nv_accounts.`acc_finalReport`
                  ,nv_accounts.`acc_Cmpy_id`
                  ,nv_accounts.`acc_ismaster`

            ORDER BY  nv_accounts.acc_no;
            END ;";
        DB::unprepared($procedure);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

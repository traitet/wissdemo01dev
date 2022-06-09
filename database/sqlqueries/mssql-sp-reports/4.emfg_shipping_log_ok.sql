USE [SIAM_SHIPPINGDB];
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- [emfg_shipping_log_ok]
-- Created by : Nuttawut
-- Created date : 23-02-2022
-- Updated date : 23-02-2022
-- =========================================================
ALTER PROCEDURE [dbo].[emfg_shipping_log_ok]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(8),
@record_count AS INT
AS

SELECT TOP (@record_count )
	DATE_CHK, TIME_CHK, PDS_NUM, PART_NUM, PART_NAME, PART_SA, PACK_QTY, PACKED, USER_CHK
FROM
	TM_LOG_OK
WHERE
	PDS_NUM = @doc_num AND
	DATE_CHK >= @start_date AND
	DATE_CHK <= @end_date

-- EXEC emfg_shipping_log_ok '20190101', '20220101','',100

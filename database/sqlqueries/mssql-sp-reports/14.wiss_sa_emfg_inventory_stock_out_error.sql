USE SIAM_ARISA_P01
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_emfg_inventory_stock_out_error]    Script Date: 3/5/2022 12:27:24 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- wiss_sa_emfg_inventory_stock_out_error
-- Created by : Satit Po
-- Created date : 23-02-2022
-- Updated date : 03-05-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_sa_emfg_inventory_stock_out_error]
@start_date AS VARCHAR(8),
@end_date AS VARCHAR(8),
@doc_num AS VARCHAR(30),
@record_count AS INT
AS

    SELECT TOP(@record_count)
        ICTTINVTPXMRID, PARTCODE, PARTNUM, FROMKBSERIAL, FROMKBTYPECODE, QTYPACK, QTY, UNIT, COMPCODE, PLANTCODE, STATUS, ENABLE,
        CREATEBY, CREATEDATE, CREATETIME, EDITBY, EDITDATE, EDITTIME, COMMENT5, TEXT1
	FROM
        ICTTINVTPXM
	WHERE
		PARTCODE LIKE '%' + @doc_num  + '%' AND
		STATUS = 'PARK' AND
		COMMENT5 = '' AND
		CREATEDATE >= @start_date AND
		CREATEDATE <= @end_date
	ORDER BY ICTTINVTPXMRID

-- EXEC [wiss_sa_emfg_inventory_stock_out_error] '20200101', '20990101','T412',100


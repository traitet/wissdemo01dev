USE [SIAM_LASER_P01]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_ifin_revert_doc]    Script Date: 3/16/2022 10:05:39 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =========================================================
-- [wiss_atac_emfg_add_model]
-- Created by : Nuttawut
-- Created date : 16-03-2022
-- Updated date : 16-03-2022
-- =========================================================
ALTER PROCEDURE[dbo].[wiss_sa_ifin_revert_doc]
 @doc_num varchar(50) =''

AS
DECLARE @DATEUPDATE VARCHAR(8)
DECLARE @TIMEUPDATE VARCHAR(6)
DECLARE @USERNAME VARCHAR(255)      ='ADMIN'
DECLARE @COMPCODE VARCHAR(255)      ='J614'
DECLARE @PLANTCODE VARCHAR(255)     ='JT'
DECLARE @STATUS VARCHAR(255)        ='Y'
DECLARE @ENABLE VARCHAR(255)        ='Y'
DECLARE @NEWID int                  =0
DECLARE @MESSAGE VARCHAR(MAX)       =''
DECLARE @SPSTATUS VARCHAR(10)       ='false'
DECLARE @RID int =                  0
DECLARE @CURRENTSTEP VARCHAR(255)   =''
DECLARE @NEWSTEP VARCHAR(255)       =''
SET @DATEUPDATE                     =FORMAT(GETDATE(),'yyyyMMdd')
SET @TIMEUPDATE                     =FORMAT(GETDATE(),'HHmmss')

BEGIN TRY
    -- ===========================================================
    -- NO COUNT FOR UPDATE, INSERT, DELETE
    -- ===========================================================
    SET NOCOUNT ON;
    -- ===========================================================
    -- SELECT
    -- ===========================================================
    SELECT TOP(1) @RID = B.WFTTWFXXXXLRID  , @CURRENTSTEP = B.STAGENAME FROM WFTTWFXXXXH AS A
    JOIN
    WFTTWFXXXXL AS B
    ON A.WFTTWFXXXXHRID = B.WFTTWFXXXXHRID
    WHERE A.DOCNUM = @DOC_NUM
    ORDER BY  B.WFTTWFXXXXLRID DESC
    -- ===========================================================
    -- DELETE
    -- ===========================================================
    DELETE WFTTWFXXXXL  WHERE WFTTWFXXXXLRID  = @RID
    -- ===========================================================
    -- SELECT
    -- ===========================================================
    SELECT
        TOP(1) @RID = B.WFTTWFXXXXLRID,
        @NEWSTEP = B.STAGENAME
    FROM
        WFTTWFXXXXH AS A JOIN
        WFTTWFXXXXL AS B ON A.WFTTWFXXXXHRID = B.WFTTWFXXXXHRID
    WHERE
        A.DOCNUM = @DOC_NUM
    ORDER BY
        B.WFTTWFXXXXLRID DESC
    -- ===========================================================
    --  UPDATE
    -- ===========================================================
    UPDATE WFTTWFXXXXL SET ACTION =''  WHERE WFTTWFXXXXLRID  = @RID

    --  RETURN
    SET @MESSAGE ='REVERSE DOCUMENT NUMBER : '+  @doc_num  +' FORM '+ @CURRENTSTEP +'  TO '+@NEWSTEP +'  COMPLETED.'
    SET @SPSTATUS ='true'
    SELECT @SPSTATUS AS status,@MESSAGE AS message

END TRY
BEGIN CATCH
		SET @SPSTATUS ='false'
	    SELECT @SPSTATUS AS status, ERROR_MESSAGE() AS message
END CATCH

---SELECT * FROM WFTTWFXXXXL
--SELECT a.DOCNUM,b.* FROM WFTTWFXXXXH AS A
--JOIN
--WFTTWFXXXXL AS B
--ON A.WFTTWFXXXXHRID = B.WFTTWFXXXXHRID
--WHERE A.DOCNUM = 'AV20000001'
--ORDER BY   a.DOCNUM , B.WFTTWFXXXXLRID DESC

-- USE [SIAM_LASER_P01]
-- EXEC	wiss_sa_ifin_revert_doc@doc_num = 'AV20000001'

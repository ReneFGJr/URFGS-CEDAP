<?php
class mets extends CI_model {
	function mets($txt) {
		$tx = '<mets:mets>'.cr();
		$tx = '<mets:metsHdr CREATEDATE="'.date("Y-m-d").'T'.date("H:i:s").'">'.cr();
		$tx = '<mets:agent ROLE="CREATOR">'.cr();
		$tx = '<mets:name>Rick Beaubien</mets:name>'.cr();
		$tx = '</mets:agent>'.cr();
		$tx = '</mets:metsHdr>'.cr();		
		$tx .=$txt.cr();
		$tx .= '</mets:mets>';
		return ($txt);
	}
}
?>

<mets:fileSec>
	<mets:fileGrp USE="archive image"></mets:fileGrp>
	<mets:fileGrp USE="reference image"></mets:fileGrp>
	<mets:fileGrp USE="thumbnail image"></mets:fileGrp>
</mets:fileSec>

<mets:fileSec>
	<mets:fileGrp USE="archive image">
		<mets:file ID="epi01m" MIMETYPE="image/tiff">
			<mets:FLocat
			xlink:href="http://www.loc.gov/standards/mets/docgroup/
			full/01.tif" LOCTYPE="URL"/>
		</mets:file>
	</mets:fileGrp>
	<mets:fileGrp USE="reference image">
		<mets:file ID="epi01r" MIMETYPE="image/jpeg">
			<mets:FLocat
			xlink:href="http://www.loc.gov/standards/mets/docgroup/jpg/01.jpg"
			LOCTYPE="URL"/>
		</mets:file>
	</mets:fileGrp>
	<mets:fileGrp USE="thumbnail image">
		<mets:file ID="epi01t" MIMETYPE="image/gif">
			<mets:FLocat
			xlink:href="http://www.loc.gov/standards/mets/docgroup/gif/01.gif"
			LOCTYPE="URL"/>
		</mets:file>
	</mets:fileGrp>
</mets:fileSec>

<mets:structMap TYPE="physical">
	<mets:div TYPE="book" LABEL="Martial Epigrams II">
		<mets:div TYPE="page" LABEL="Blank page"></mets:div>
		<mets:div TYPE="page" LABEL="Page i: Half title page"></mets:div>
		<mets:div TYPE="page" LABEL="Page ii: Blank page"></mets:div>
		<mets:div TYPE="page" LABEL="Page iii: Title page"></mets:div>
		<mets:div TYPE="page" LABEL="Page iv: Publication info"></mets:div>
		<mets:div TYPE="page" LABEL="Page v: Table of contents"></mets:div>
		<mets:div TYPE="page" LABEL="Page vi: Blank page"></mets:div>
		<mets:div TYPE="page" LABEL="Page 1: Half title page"></mets:div>
		<mets:div TYPE="page" LABEL="Page 2 (Latin)"></mets:div>
		<mets:div TYPE="page" LABEL="Page 3 (English)"></mets:div>
		<mets:div TYPE="page" LABEL="Page 4 (Latin)"></mets:div>
		<mets:div TYPE="page" LABEL="Page 5 (English)"></mets:div>
	</mets:div>
</mets:structMap>

<mix:mix>
	<mix:BasicImageParameters>
		<mix:Format>
			<mix:MIMEType>
				image/tiff
			</mix:MIMEType>
			<mix:ByteOrder>
				little-endian
			</mix:ByteOrder>
			<mix:Compression>
				<mix:CompressionScheme>
					1
				</mix:CompressionScheme>
			</mix:Compression>
			<mix:PhotometricInterpretation>
				<mix:ColorSpace>
					1
				</mix:ColorSpace>
			</mix:PhotometricInterpretation>
			<mix:Segments>
				<mix:StripOffsets>
					17810
				</mix:StripOffsets>
				<mix:RowsPerStrip>
					3948
				</mix:RowsPerStrip>
				<mix:StripByteCounts>
					10256904
				</mix:StripByteCounts>
			</mix:Segments>
			<mix:PlanarConfiguration>
				1
			</mix:PlanarConfiguration>
		</mix:Format>
		<mix:File>
			<mix:Orientation>
				1
			</mix:Orientation>
		</mix:File>
	</mix:BasicImageParameters>
	<mix:ImageCreation>
		<mix:ScanningSystemCapture>
			<mix:ScanningSystemSoftware>
				<mix:ScanningSoftware>
					Adobe Photoshop CS Macintosh
				</mix:ScanningSoftware>
			</mix:ScanningSystemSoftware>
		</mix:ScanningSystemCapture>
		<mix:DateTimeCreated>
			2006-03-13T12:05:05
		</mix:DateTimeCreated>
	</mix:ImageCreation>
	<mix:ImagingPerformanceAssessment>
		<mix:SpatialMetrics>
			<mix:SamplingFrequencyUnit>
				2
			</mix:SamplingFrequencyUnit>
			<mix:XSamplingFrequency>
				600
			</mix:XSamplingFrequency>
			<mix:YSamplingFrequency>
				600
			</mix:YSamplingFrequency>
			<mix:ImageWidth>
				2598
			</mix:ImageWidth>
			<mix:ImageLength>
				3948
			</mix:ImageLength>
		</mix:SpatialMetrics>
		<mix:Energetics>
			<mix:BitsPerSample>
				8
			</mix:BitsPerSample>
			<mix:SamplesPerPixel>
				1
			</mix:SamplesPerPixel>
		</mix:Energetics>
	</mix:ImagingPerformanceAssessment>
</mix:mix>
</mets:xmlData>
</mets:mdWrap>
</mets:techMD>
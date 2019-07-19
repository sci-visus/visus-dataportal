#***************************************************
#** ViSUS Visualization Project                    **
#** Copyright (c) 2010 University of Utah          **
#** Scientific Computing and Imaging Institute     **
#** 72 S Central Campus Drive, Room 3750           **
#** Salt Lake City, UT 84112                       **
#**                                                **
#** For information about this project see:        **
#** http:#www.pascucci.org/visus/                 **
#**                                                **
#**      or contact: pascucci@sci.utah.edu         **
#**                                                **
#****************************************************

# This script queries dcm files 
# Requirements: pydicom (e.g., pip install pydicom), gdcm (e.g., brew install gdcm)

import os
import pydicom
import OpenVisus
from OpenVisus import *

def info(imgpath):
    first_img=pydicom.dcmread(imgpath)

    print('<dims=" '+str(first_img.pixel_array.shape[0])+' '+str(first_img.pixel_array.shape[1])+'" format="dicom" url="'+imgpath+'">')
    print('<fields> <field dtype="'+DType.fromString(str(first_img.pixel_array.dtype)).toString()+'" /> </fields>')


# ############################
if __name__ == '__main__':

    import argparse
    parser = argparse.ArgumentParser(description="Info DCM data")
    parser.add_argument("-f","--file"   ,default="",       help="dcm file")
    args = parser.parse_args()

    out=info(args.file)



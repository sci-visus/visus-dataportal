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

# This script convert dcm files to IDX format
# Requirements: pydicom (e.g., pip install pydicom), gdcm (e.g., brew install gdcm)

import os
import pydicom
import OpenVisus
from OpenVisus import *

# those are the axis position in DICOM (apparently)
X_POS=1
Y_POS=0

def convert(folder_path, idx_path, extname="dcm"):
    images = []

    for f in os.listdir(folder_path):
      if f.endswith(extname):
        filepath=folder_path+"/"+f
        s = os.path.basename(f)
        # filepath = filepath.replace('(','\(')                                                                      
        # filepath = filepath.replace(')','\)')                                                                      
        images.append(filepath)

    first_img=pydicom.dcmread(images[0])

    pixelDims = (int(first_img.Rows), int(first_img.Columns))
    pixelSpacing = (float(first_img.PixelSpacing[X_POS]), float(first_img.PixelSpacing[Y_POS]), float(first_img.SliceThickness))

    dims=[first_img.pixel_array.shape[X_POS], first_img.pixel_array.shape[Y_POS], len(images)]

    print(dims, pixelSpacing)

    # Set logical bounds
    idxfile = IdxFile()

    # new OpenVisus 
    idxfile.logic_box = BoxNi(PointNi(0, 0, 0), PointNi(dims[0], dims[1], dims[2]))
    idxfile.bounds = Position(BoxNd(PointNd(0, 0, 0), PointNd(pixelSpacing[0]*dims[0], pixelSpacing[1]*dims[1], pixelSpacing[2]*dims[2])))
    # old OpenVisus
    #idxfile.box = NdBox(NdPoint(0, 0, 0), NdPoint.one(dims[0], dims[1], dims[2]))

    # Note: assuming one single field 
    f=Field("data",DType.fromString(str(first_img.pixel_array.dtype)))
    idxfile.fields.push_back(f)

    # Note: assuming single timestep

    # if idxinfo.timesteps > 0:
    #     idxfile.timesteps.addTimesteps(0, idxinfo.timesteps-1,1);
    #     idxfile.time_template="time%0"+str(len(str(idxinfo.timesteps)))+"d/"

    saved = idxfile.save(idx_path)

    assert saved

    print("Idx file created", saved)

    dataset=LoadDataset(idx_path);
    access=dataset.createAccess()
    
    images.sort()

    for i, img in enumerate(images):
        ds = pydicom.dcmread(img)
        sh = ds.pixel_array.shape
        dt = ds.pixel_array.dtype
        #print("shape", sh, "dtype", dt)

        #slice_box=dataset.getBox().getZSlab(i,i+1) 
        slice_box=dataset.getLogicBox().getZSlab(i,i+1) 
        
        #slice_box=BoxNi(PointNi(0, 0, i), PointNi(first_img.pixel_array.shape[0]-1, first_img.pixel_array.shape[1]-1, i+1))

        # convert the field
        query=BoxQuery(dataset, dataset.getDefaultField(),dataset.getDefaultTime(), ord('w'))
        query.logic_box=slice_box
        dataset.beginQuery(query)

        assert query.isRunning()

        print(slice_box.toString(), query.getNumberOfSamples().toString(), query.getNumberOfSamples().innerProduct())

        assert query.getNumberOfSamples().innerProduct()==(sh[0])*(sh[1])

        query.field=dataset.getDefaultField()
        query.time=0
        query.buffer=Array.fromNumPy(ds.pixel_array)

        exeQ=dataset.executeQuery(access, query)
        
        assert exeQ

        print("Slice ", i, "imported successfully")


# ############################
if __name__ == '__main__':

    import argparse
    parser = argparse.ArgumentParser(description="Convert DCM data to IDX format.")
    parser.add_argument("-f","--folder"   ,default="",       help="folder to convert")
    parser.add_argument("-i","--idxpath" ,default="",        help="destination idx volume")
    args = parser.parse_args()

    IdxModule.attach()
    out=convert(args.folder, args.idxpath)
    IdxModule.detach()



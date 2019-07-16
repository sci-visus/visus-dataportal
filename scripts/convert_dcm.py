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

    dims=[first_img.pixel_array.shape[0], first_img.pixel_array.shape[1], len(images)]

    # Set logical bounds
    idxfile = IdxFile()

    # new OpenVisus (limortaccidegiorgio)
    #idxfile.box = BoxNi(PointNi(0, 0, 0), PointNi(dims[0], dims[1], dims[2]))
    # old OpenVisus
    idxfile.box = NdBox(NdPoint(0, 0, 0), NdPoint(dims[0], dims[1], dims[2]))

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

    images.sort()

    for i, img in enumerate(images):
        ds = pydicom.dcmread(img)
        sh = ds.pixel_array.shape
        dt = ds.pixel_array.dtype
        #print("shape", sh, "dtype", dt)

        slice_box=dataset.getBox().getZSlab(i,i+1) 
        #slice_box=BoxNi(PointNi(0, 0, i), PointNi(first_img.pixel_array.shape[0]-1, first_img.pixel_array.shape[1]-1, i+1))

        access=dataset.createAccess()

        # convert the field
        query=Query(dataset, ord('w'))
        query.position=Position(slice_box)
        ret1=dataset.beginQuery(query)

        assert ret1

        print(slice_box.toString(), query.nsamples.toString(), query.nsamples.innerProduct())

        assert query.nsamples.innerProduct()==(sh[0])*(sh[1])

        query.field=dataset.getDefaultField()
        query.time=0
        query.buffer=Array.fromNumPy(ds.pixel_array)

        ret2=dataset.executeQuery(access, query)
        
        assert ret2

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



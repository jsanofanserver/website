def markerFilter(poi):
    if poi['id'] == 'Marker':
        return poi['name']

worlds["vanilla"] = "/home/jfs/vanilla/world"

renders["vanillanorth"] = {
    "world": "vanilla",
    "title": "North",
    "rendermode": smooth_lighting,
    "dimension": "overworld",
    "manualpois":[
                   {'id':'Marker',
                    'x':-500,
                    'y':64,
                    'z':4368,
                    'name':'Ace\'s Hockey Stadium'},
                   {'id':'Marker',
                    'x':-500,
                    'y':64,
                    'z':4368,
                    'name':'Nayxer\'s Underground Base'},
                   {'id':'Marker',
                    'x':-500,
                    'y':64,
                    'z':4368,
                    'name':'Altruba Village'},
                   {'id':'Marker',
                    'x':-500,
                    'y':64,
                    'z':4368,
                    'name':'StreetCredCookie\'s Volcano Base'},
                   {'id':'Marker',
                    'x':-500,
                    'y':64,
                    'z':4368,
                    'name':'JSanoland'},
                   {'id':'Marker',
                    'x':-500,
                    'y':64,
                    'z':4368,
                    'name':'DennisFlux\'s Modern Base'},
                   {'id':'Marker',
                    'x':565,
                    'y':64,
                    'z':534,
                    'name':'Shop Town'},
                   {'id':'Marker',
                    'x':3323,
                    'y':85,
                    'z':585,
                    'name':'Jungle Spawn'}],
    "markers": [dict(name="Markers", filterFunction=markerFilter, icon="icons/marker_town.png", checked=True)],
}

renders["vanillasouth"] = {
    "world": "vanilla",
    "title": "South",
    "rendermode": smooth_lighting,
    "dimension": "overworld",
    "northdirection": "lower-right",
    "manualpois":[
                   {'id':'Marker',
                    'x':-500,
                    'y':64,
                    'z':4368,
                    'name':'Ace\'s Hockey Stadium'},
                   {'id':'Marker',
                    'x':646,
                    'y':81,
                    'z':2227,
                    'name':'Nayxer\'s Underground Base'},
                   {'id':'Marker',
                    'x':3358,
                    'y':63,
                    'z':-5320,
                    'name':'Altruba Village'},
                   {'id':'Marker',
                    'x':2102,
                    'y':64,
                    'z':-5495,
                    'name':'StreetCredCookie\'s Volcano Base'},
                   {'id':'Marker',
                    'x':295,
                    'y':64,
                    'z':1275,
                    'name':'JSanoland'},
                   {'id':'Marker',
                    'x':844,
                    'y':64,
                    'z':652,
                    'name':'DennisFlux\'s Modern Base'},
                   {'id':'Marker',
                    'x':565,
                    'y':64,
                    'z':534,
                    'name':'Shop Town'},
                   {'id':'Marker',
                    'x':3323,
                    'y':85,
                    'z':585,
                    'name':'Jungle Spawn'}],
    "markers": [dict(name="Markers", filterFunction=markerFilter, icon="icons/marker_town.png", checked=True)],
}

outputdir = "/var/www/html/overviewer"
texturepath = "/var/www/html/overviewer/1.10.jar"

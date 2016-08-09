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
                    'x':-760,
                    'y':64,
                    'z':165,
                    'name':'Rad\'s Diamond Monument - 1000 Diamonds for 1000 Hours'},
                   {'id':'Marker',
                    'x':-1190,
                    'y':64,
                    'z':740,
                    'name':'Farm Town'},
                   {'id':'Marker',
                    'x':68,
                    'y':95,
                    'z':942,
                    'name':'Hanging Gardens of Babyluck'},
                   {'id':'Marker',
                    'x':-808,
                    'y':64,
                    'z':-726,
                    'name':'Guardian Farm'},
                   {'id':'Marker',
                    'x':300,
                    'y':64,
                    'z':-155,
                    'name':'Project Kowloon'},
                   {'id':'Marker',
                    'x':3149,
                    'y':64,
                    'z':270,
                    'name':'Zalpha\'s Casa Base'},
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
                    'x':-760,
                    'y':64,
                    'z':165,
                    'name':'Rad\'s Diamond Monument - 1000 Diamonds for 1000 Hours'},
                   {'id':'Marker',
                    'x':-1190,
                    'y':64,
                    'z':740,
                    'name':'Farm Town'},
                   {'id':'Marker',
                    'x':68,
                    'y':95,
                    'z':942,
                    'name':'Hanging Gardens of Babyluck'},
                   {'id':'Marker',
                    'x':-808,
                    'y':64,
                    'z':-726,
                    'name':'Guardian Farm'},
                   {'id':'Marker',
                    'x':300,
                    'y':64,
                    'z':-155,
                    'name':'Project Kowloon'},
                   {'id':'Marker',
                    'x':3149,
                    'y':64,
                    'z':270,
                    'name':'Zalpha\'s Casa Base'},
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

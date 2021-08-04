namespace App\Services;


class PictureService
{
    public function store($picture, $type)
    {
        switch ($type) {
            case 'attraction':
                $folder = 'attraction';
                break;
            case 'user':
                $folder = 'user';
                break;
            default:
                $folder = '';
                break;
        }


        $newName = uniqid().'.'.$picture->getClientOriginalExtension();

        $picture->move(public_path('storage/images/'. $folder), $newName);

        return [
            'path' => $folder,
            'name' => $newName
        ];

    }


}
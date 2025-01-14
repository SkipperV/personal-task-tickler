import {useEffect, useState} from 'react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import SpacesListSidebar from '@/Components/Sidebars/SpacesListSidebar.jsx';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import {Link} from '@inertiajs/react';

export default function Authenticated({user, header, children, activeSpace}) {
    const [loading, setLoading] = useState(true);
    const [spacesList, setSpacesList] = useState([]);

    useEffect(() => {
        const fetchSpaces = async () => {
            try {
                const response = await axios.get(route('api.spaces.index'));
                setSpacesList(response.data);
            } catch (e) {
                console.error("Error loading spaces", e);
            } finally {
                setLoading(false);
            }
        }

        fetchSpaces()
    }, []);

    return (
        <div className="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav
                className="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 z-30 fixed w-full top-0 left-0 ">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between h-16">
                        <div className="flex">
                            <div className="shrink-0 flex items-center">
                                <Link href="/">
                                    <ApplicationLogo
                                        className="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>
                                </Link>
                            </div>

                            <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink href={route('home.index')} active={route().current('home.index')}>
                                    Homepage
                                </NavLink>
                                <NavLink href={route('spaces.index')} active={route().current('spaces.*')}>
                                    Spaces
                                </NavLink>
                            </div>
                        </div>

                        <div className="hidden sm:flex sm:items-center sm:ms-6">
                            <div className="ms-3 relative">
                                <Dropdown>
                                    <Dropdown.Trigger>
                                        <span className="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {user.username}

                                                <svg
                                                    className="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fillRule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clipRule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </Dropdown.Trigger>

                                    <Dropdown.Content>
                                        <Dropdown.Link href={route('profile.edit')}>Profile</Dropdown.Link>
                                        <Dropdown.Link href={route('logout')} method="post" as="button">
                                            Log Out
                                        </Dropdown.Link>
                                    </Dropdown.Content>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <div className="flex min-h-screen pt-16">

                    <SpacesListSidebar spacesList={spacesList}/>

                <main className="mx-auto flex-grow p-6 z-10">
                    {children}
                </main>
            </div>
        </div>
    )
        ;
}
